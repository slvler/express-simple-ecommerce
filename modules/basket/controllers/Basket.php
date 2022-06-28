<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Basket extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('basket/Basket_model');
		$this->load->model('member/Member_model');
		$this->load->model('regions/Regions_model');
		$this->load->model('payment_method/Payment_method_model');
		$this->load->helper('product/product');
		IyzipayBootstrap::init();
	}

	private function options()
	{
		// seçilen şubenin api ve secret keyleri alınıyor.
		$api_key = $this->session->userdata("branchData")["api_key"];
		$secret_key = $this->session->userdata("branchData")["secret_key"];
		$options = new \Iyzipay\Options();
        $options->setApiKey($api_key);
        $options->setSecretKey($secret_key);
        $options->setBaseUrl("https://api.iyzipay.com");

		// $options->setApiKey("sandbox-CXCaNLZozaJaRGcHfF4uWV4b7qQeys70");
		// $options->setSecretKey("sandbox-rvKBB4FHmU6cQxM7nX82Om9y0F3gW89p");
  //    $options->setBaseUrl("https://sandbox-api.iyzipay.com");

		return $options;
	}

	public function index()
	{
		if ($this->cart->contents()) {
			$this->data['page']["title"] = "Sepetim";
			$this->load->view('basket/index', $this->data);
			$this->session->unset_userdata('basket_note');
		}else{
			$this->session->set_flashdata("error_message", 'Sepetinizde ürün bulunmamaktadır.');
			redirect('/',"refresh");
		}
	}

	public function add()
	{
		// print($this->input->post("prod_code"));exit;
		$prod_code	= $this->input->post("prod_code");
		// veritabanından id ile ürünü çekiyor
		$product	= $this->Basket_model->get_product($prod_code);
		$price_type = "";
		// print_r($this->input->post());exit;
		if (strstr($product["price"], "-")) {
			$price_type = $this->input->post("price_type");
			$prod_price = explode("-", $product["price"]);
			if ($this->input->post("price_type")=="PORS") {
				$product["price"] = $prod_price[0];
			}else{
				$product["price"] = $prod_price[1];
			}
		}
		$control = 0;
		foreach ($this->cart->contents() as $item) {
			$control = 0;
			if (@$item["prod_code"] == $prod_code) {
				$control = 1;
			}
		}

		if ($control==0) {
			// online fiyatlara menü üzerine ek olarak fiyat ekleniyor.
			$price = str_replace(",", "", $product["price"]) + settings("additional_price");
			// sepete ekleme işlemi
			$data = array(
				'id'		=> $product["id"],
				'prod_code'	=> $product["prod_code"],
				'price_type'=> $price_type,
				'title'		=> $product["title"],
				'list_img'	=> $product["list_img"],
				'qty'		=> $this->input->post("quantity"),
				'price'		=> $price,
				'name'		=> str_replace(array("&#039;",",","'"),"",$product["title"])
			);
			$this->cart->insert($data);
			if (@$this->input->post("property") != NULL && @$this->input->post("property") != "on") {
				$property_product	= $this->Basket_model->get_product($this->input->post("property"));
				// ekstra ürün sepete ekleme işlemi
				$data = array(
					'id'		=> $property_product["id"],
					'prod_code'	=> $property_product["prod_code"],
					'title'		=> $property_product["title"],
					'list_img'	=> $property_product["list_img"],
					'qty'		=> $this->input->post("quantity"),
					'price'		=> str_replace(",", "", $property_product["price"]),
					'name'		=> str_replace(array("&#039;",",","'"),"",$property_product["title"])
				);
				$this->cart->insert($data);
			}
		}else{
			// sepet güncelleme işlemi
			foreach ($this->cart->contents() as $row) {
				if ($prod_code == $row["prod_code"]) {
					$data[] = array("rowid" => $row["rowid"], "qty" => $row["qty"]+$this->input->post("quantity"));
				}
			}
			$this->cart->update($data);
			if (@$this->input->post("property") != NULL && @$this->input->post("property") != "on") {
				$property_product	= $this->Basket_model->get_product($this->input->post("property"));
				// ekstra ürün sepete ekleme işlemi
				$data = array(
					'id'		=> $property_product["id"],
					'prod_code'	=> $property_product["prod_code"],
					'title'		=> $property_product["title"],
					'list_img'	=> $property_product["list_img"],
					'qty'		=> $this->input->post("quantity"),
					'price'		=> str_replace(",", "", $property_product["price"]),
					'name'		=> str_replace(array("&#039;",",","'"),"",$property_product["title"])
				);
				$this->cart->insert($data);
			}
		}
		$this->session->set_flashdata("success_message", 'Ürün sepete eklendi.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function update_qty()
	{
		if ($_POST) {
			$prod_code	= $this->input->post("prod_code");
			// sepet güncelleme işlemi
			foreach ($this->cart->contents() as $row) {
				if ($prod_code == $row["prod_code"]) {
					if ($this->input->post("value")==0) {
						$data[] = array("rowid" => $row["rowid"], "qty" => $row["qty"]-1);
					}else{
						$data[] = array("rowid" => $row["rowid"], "qty" => $row["qty"]+1);
					}
				}
			}
			$this->cart->update($data);
			$this->session->set_flashdata("success_message", 'Ürün miktarı güncellendi.');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete()
	{
		// URL den ürün id yi alıyor
		$prod_code	= (int) $this->uri->segment(3);
		// sepet ürün silme işlemi
		foreach ($this->cart->contents() as $row) {
			if ($prod_code == $row["prod_code"]) {
				$data[] = array("rowid" => $row["rowid"], "qty" => 0);
			}
		}
		$this->cart->update($data);
		$this->session->set_flashdata("success_message", 'Ürün sepetinizden kaldırıldı.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function order()
	{
		if(count($this->cart->contents()) > 0){
			// sipariş bilgilerinin alındığı sayfa
			$this->data['page']["title"] = "Sipariş Bilgileri";
			$this->load->view('basket/order', $this->data);
		}else{
			// sepet boş ise uyarı sayfasına atıyor
			redirect('basket', 'refresh');
		}
	}

	public function payment_info()
	{
		// şubenin minimum sipariş limiti kontrolü
		$district = $this->session->userdata("locationData")["district"];
		$region_info = $this->Regions_model->record($this->session->userdata("branchData")["id"])->district_min_order;
		$min_order = 0;
		foreach (json_decode($region_info) as $key => $value) {
			if ($key==$district) {
				$min_order = number_format($value,2);
			}
		}
		if ($min_order > $this->cart->total()) {
			$this->session->set_flashdata("error_message", "Bu bölge için minimum sipariş tutarı ".$min_order." TL olmalıdır.");
			redirect('basket', 'refresh');
		}else{
			// ödeme bilgilerinin alındığı sayfa
			if(count($this->cart->contents()) > 0){
				if ($_POST) {
					$this->session->set_userdata("basket_note", $this->input->post("basket_note"));
				}
				$this->session->set_userdata("control", 0);
				// ödeme methodları getiriliyor ve şubede görünmeyecek olanlar çıkarılıyor.
				$payment_methods = $this->Payment_method_model->get_payment_method();
				$region_method = array();
				$region_payment_method = json_decode($this->Regions_model->record($this->session->userdata("branchData")["id"])->invisible_payment_method);
				foreach ($payment_methods as $row) {
					$control = 0;
					if (@$region_payment_method) {
						foreach ($region_payment_method as $item) {
							if ($item==$row->id) {
								$control = 1;
							}
						}
					}
					if ($control==0) {
						array_push($region_method, $row);
					}
				}
				$this->data['payment_methods'] = $region_method;
				$this->data['page']["title"] = "Ödeme Bilgileri";
				$this->load->view('basket/payment_info', $this->data);
			}else{
				// post ile sipariş bilgileri gelmemiş ise sipariş sayfasına geri yönlendiriyor
				redirect('basket', 'refresh');
			}
		}
	}

	public function payment()
	{
		if($_POST && $this->session->userdata("control")==0){
			$this->load->helper('member/member');
			// Kullanıcı daha önceden eklenmiş bir adresi seçtiyse, siparişe eklemek üzere hazırlıyoruz. Eğer yeni bir adres girdiyse, adreslere kaydedip siparişe eklemek üzere hazırlıyoruz.
			// Teslimat adresi işlemleri
			if (@$this->session->userdata('member_logged_in')) {
				if (@$this->input->post('address_id')) {
					$address = $this->Member_model->get_address($this->session->userdata('member_logged_in')["id"],$this->input->post('address_id'));
					if ($address->city != $this->session->userdata("locationData")["city"] || $address->town != $this->session->userdata("locationData")["town"] || $address->district != $this->session->userdata("locationData")["district"]) {
						$this->session->set_flashdata("error_message", "Seçtiğiniz adres siparişi vermek istediğiniz şubenin gönderim alanı dışındadır. Şubenin hizmet verdiği bölgede bir adres seçerek ya da yeni bir adres ekleyerek sipariş verebilirsiniz.");
						redirect('basket/payment_info','refresh');
					}
					$address_id = $this->Member_model->get_address($this->session->userdata('member_logged_in')["id"],$this->input->post('address_id'))->id;
				}else{
					$address_id = $this->Member_model->newAddressAdd($this->session->userdata('member_logged_in')["id"],$this->input->post());
				}
				$member_id = $this->session->userdata('member_logged_in')["id"];
			}else{
				// sipariş aşamasında girilen e-posta ile üye bilgileri alıyoruz. Üye girişi yapmadan girdiği e-posta sistemde var ise devam etmiyoruz ve uyarı veriyoruz.
				$member_info = $this->Member_model->get_member_session($this->input->post('email'));
				if ($member_info) {
					$this->session->set_flashdata("error_message", "Girdiğiniz e-posta adresi sistemde kayıtlıdır. Lütfen giriş yapın veya farklı bir e-posta ile kayıt olmayı deneyin.");
					redirect('basket/payment_info','refresh');
				}else{
					// giriş yapılan bilgilerle kullanıcının şifresini oluşturup üye yapıyoruz ve adres bilgisini sisteme kayıt ediyoruz.
					$character = "1234567890abcdefghijKLMNOPQRSTuvwxyzABCDEFGHIJklmnopqrstUVWXYZ0987654321";
					$password = '';
					for($i=0;$i<8;$i++)
					{
						$password .= $character{rand() % 72};
					}
					$member_id = $this->Member_model->add_order_user($this->input->post(),$password);
					$address_id = $this->Member_model->newAddressAdd($member_id,$this->input->post());
				}
			}
			// sipariş numarası
			$orderkey = "OZSUT_".strtoupper(substr(md5(microtime()), 0,17));
			$this->load->helper('campaign/campaign');
			$campaign = campaigns(1);
			$campaign_options = json_decode(campaigns(1)["options"]);
			$total_price = $this->cart->total();
			$discount_price = 0;
			if ($campaign["active"] == 1 && number_format($total_price,2) >= $campaign_options->order_price) {
				// indirim tutarı işlemleri
				// indirim fiyatı hesaplanıyor.
				$result = number_format($total_price,2) / $campaign_options->order_price;
				$discount_price = $campaign_options->discount_price * (int)$result;
				// toplam fiyattan indirim oranı çıkarılıyor.
				$total_price = str_replace(",", "", $total_price) - $discount_price;
			}
			if($this->input->post("paymentmethod") == "Online Kredi Kartı Ödeme"){
				// veritabanına ekleme fonksiyonu
				$order_id = $this->Basket_model->add_order($total_price,$discount_price,$this->session->userdata('basket_note'),$this->input->post(),$address_id,$member_id, $this->input->post("paymentmethod"), $orderkey,"Onaylanmamış","Sipariş tamamlanmamış.");

				$memberData = get_member($member_id);
				$adressData = get_address($member_id,$address_id);

				$cardDate = explode("/",$this->input->post("carddate"));
				$cardMonth = trim($cardDate[0]);
				$cardYear = "20".trim($cardDate[1]);

				if ($memberData["email"]=="mert.yaman@egegen.com") {
					$total_price = 1;
				}

				$request = new \Iyzipay\Request\CreatePaymentRequest();
				$request->setLocale(\Iyzipay\Model\Locale::TR);
				$request->setConversationId($orderkey);
				$request->setPrice(number_format($this->cart->total(), 1));
				$request->setPaidPrice(number_format($total_price, 1));
				$request->setCurrency(\Iyzipay\Model\Currency::TL);
				$request->setInstallment(1);
				$request->setBasketId($orderkey);
				$request->setPaymentChannel(\Iyzipay\Model\PaymentChannel::WEB);
				$request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
				$request->setCallbackUrl(base_url("basket/completed"));
				$paymentCard = new \Iyzipay\Model\PaymentCard();
				$paymentCard->setCardHolderName($this->input->post("cardname"));
				$paymentCard->setCardNumber(str_replace(" ", "", $this->input->post("cardno")));
				$paymentCard->setExpireMonth($cardMonth);
				$paymentCard->setExpireYear($cardYear);
				$paymentCard->setCvc($this->input->post("ccv2"));
				$paymentCard->setRegisterCard(0);
				$request->setPaymentCard($paymentCard);
				$buyer = new \Iyzipay\Model\Buyer();
				$buyer->setId($memberData["id"]);
				$buyer->setName($memberData["name"]);
				$buyer->setSurname($memberData["surname"]);
				$buyer->setGsmNumber($memberData["phone"]);
				$buyer->setEmail($memberData["email"]);

                // TC NUMARASI ///
				$buyer->setIdentityNumber($memberData["tcno"]);

				$buyer->setRegistrationAddress(!empty($adressData["address"]) ? $adressData["address"] : "Deneme Adres Test");
				$buyer->setIp($this->input->ip_address());
				$buyer->setCity(get_city_title($adressData["city"]));
				$buyer->setCountry("Turkey");
				$request->setBuyer($buyer);

				$shippingAddress = new \Iyzipay\Model\Address();
				$shippingAddress->setContactName($memberData["name"]." ".$memberData["surname"]);
				$shippingAddress->setCity(get_city_title($adressData["city"]));
				$shippingAddress->setCountry("Turkey");
				$shippingAddress->setAddress(!empty($adressData["address"]) ? $adressData["address"] : "Deneme Adres Test");
				$request->setShippingAddress($shippingAddress);
				$billingAddress = new \Iyzipay\Model\Address();
				$billingAddress->setContactName($memberData["name"]." ".$memberData["surname"]);
				$billingAddress->setCity(get_city_title($adressData["city"]));
				$billingAddress->setCountry("Turkey");
				$billingAddress->setAddress(!empty($adressData["address"]) ? $adressData["address"] : "Deneme Adres Test");
				$request->setBillingAddress($billingAddress);

				$basketItems = array();
				$i = 0;
				foreach ($this->cart->contents() as $product) {
					$BasketItem[$i] = new \Iyzipay\Model\BasketItem();
					$BasketItem[$i]->setId($product["id"]);
					$BasketItem[$i]->setName($product["title"]);
					$BasketItem[$i]->setCategory1(get_parent_category($product["id"]));
					$BasketItem[$i]->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
					$BasketItem[$i]->setPrice(number_format($product["subtotal"], 1));
					$basketItems[$i] = $BasketItem[$i];
					$i++;
				}
				$request->setBasketItems($basketItems);

				$threedsInitialize = \Iyzipay\Model\ThreedsInitialize::create($request, $this->options());
				if ($threedsInitialize->getStatus() == "success") {
					echo $threedsInitialize->getHtmlContent();
				} else {
					$this->Basket_model->update_order($orderkey, "Ödeme Hatası! (" . $threedsInitialize->getErrorMessage() . ")", "Onaylanmamış");
					$this->session->set_flashdata("error_message", $threedsInitialize->getErrorMessage());
					redirect('/basket', 'refresh');
				}

			}else{
				// veritabanına ekleme fonksiyonu
				$order_id = $this->Basket_model->add_order($total_price,$discount_price,$this->session->userdata('basket_note'),$this->input->post(),$address_id,$member_id, $this->input->post("paymentmethod"), $orderkey,"Bekliyor","");

				// müşteriye ve admine bilgi maili gidiyor
				$member_mail_content = order_mail_to_member($this->session->userdata('basket_note'),$this->input->post(),$address_id,$member_id,$orderkey,$this->input->post("paymentmethod"));
				$admin_mail_content = order_mail_to_admin($this->session->userdata('basket_note'),$this->input->post(),$address_id,$member_id,$orderkey,$this->input->post("paymentmethod"));
				$member = get_member($member_id);
				$this->Basket_model->order_mail_to_member($member["email"],$member_mail_content);
				$this->Basket_model->order_mail_to_admin($admin_mail_content);
				// sessiondaki sipariş bilgilerini siliyor
				$this->session->unset_userdata('basket_note');
				// sepeti boşaltıyor
				$this->cart->destroy();
				$this->session->set_userdata("control", 1);
				// sonuç sayfasını gösteriyor
				$this->data['orderkey'] = $orderkey;
				$this->data['page']["title"] = "Siparişiniz Alındı!";
				$this->load->view('basket/completed', $this->data);
			}
		}else{
			redirect(site_url(), 'refresh');
		}
	}


	public function completed()
	{
		$request = new \Iyzipay\Request\CreateThreedsPaymentRequest();
		$request->setLocale(\Iyzipay\Model\Locale::TR);
		$request->setConversationId("123456789");
		$request->setPaymentId($_POST["paymentId"]);
		$request->setConversationData("");
		$threedsPayment = \Iyzipay\Model\ThreedsPayment::create($request, $this->options());
		if ($threedsPayment->getStatus() == "success") {
			$order_products = (array) json_decode($this->Basket_model->check_order_key($_POST["conversationId"])->products, true);
			$update_order = $this->Basket_model->update_order($_POST["conversationId"], "Ödeme tamamlanmış", "Bekliyor");
            // müşteriye ve admine bilgi maili gidiyor

			$orderRow = $this->Basket_model->check_order_key($_POST["conversationId"]);
			$member_mail_content = order_mail_to_member_kk($this->session->userdata('basket_note'),"",$orderRow->address_id,$orderRow->member_id,$_POST["conversationId"],"Online Kredi Kartı Ödeme",$order_products);
			$admin_mail_content = order_mail_to_admin_kk($this->session->userdata('basket_note'),"",$orderRow->address_id,$orderRow->member_id,$_POST["conversationId"],"Online Kredi Kartı Ödeme",$order_products);
			$member = get_member($orderRow->member_id);
			$this->Basket_model->order_mail_to_member($member["email"],$member_mail_content);
			$this->Basket_model->order_mail_to_admin($admin_mail_content);
			// sessiondaki sipariş bilgilerini siliyor
			$this->session->unset_userdata('basket_note');
			if ($member_mail_content) {
            	// sepeti boşaltıyor
				$this->cart->destroy();
			}
            // sonuç sayfasını gösteriyor
			$this->data['orderkey'] = $_POST["conversationId"];
			$this->data['page']["title"] = "Siparişiniz Alındı!";
			$this->load->view('basket/completed', $this->data);
		} else {
			$this->Basket_model->update_order($_POST["conversationId"], "Ödeme Hatası! (" . $threedsPayment->getErrorMessage() . ")", "Onaylanmamış");
			$this->session->set_flashdata("error_message", $threedsPayment->getErrorMessage());
			redirect('/basket', 'refresh');
		}
	}

}
