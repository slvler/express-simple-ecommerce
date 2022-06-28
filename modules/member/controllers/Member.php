<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('member/Member_model');
		$this->load->model('regions/Regions_model');
	}
	
	public function index()
	{
		if(isset($this->session->userdata['member_logged_in'])){
			// Üye girişi yapılmışsa profil sayfasına yönlendiriliyor
			redirect(site_url("profilim"), 'refresh');
		}else{
			// Üye girişi yapılmamış ise giriş sayfasına yönlendiriliyor
			redirect(site_url("giris-yap"), 'refresh');
		}
	}
	
	public function profile()
	{
		if(isset($this->session->userdata['member_logged_in'])){

			if ($_POST) {
				if ($this->session->userdata['member_logged_in']['email'] != $this->input->post('email')) {
					$control = $this->Member_model->get_member_session($this->input->post('email'));
					if ($control) {
						$this->session->set_flashdata("warning", "Yeni eklediğiniz mail adresi kullanılamaz. Verileriniz güncellenmemiştir.");
						redirect(site_url("profilim"), 'refresh');
					}
				}
				if (strlen($this->input->post('tcno')) != 11) {
					$this->session->set_flashdata("warning", "Lütfen geçerli bir TC Kimlik Numarası giriniz.");
					redirect(site_url("profilim"), 'refresh');
				}

				$this->Member_model->update($this->input->post(), $this->session->userdata['member_logged_in']['id']);
				$this->session->set_flashdata("success_message", "Profil bilgileriniz güncellenmiştir!");
				redirect(site_url("profilim"), 'refresh');
			}

			$this->data['record'] = $this->Member_model->member($this->session->userdata['member_logged_in']['id']);
			$this->data['page']["title"] = "Profilim";
			$this->load->view('member/profile', $this->data);
		}else{
			// Üye girişi yapılmamış ise giriş sayfasına yönlendiriliyor
			redirect(site_url("giris-yap"), 'refresh');
		}
	}
	
	public function login()
	{
		if(! isset($this->session->userdata['member_logged_in'])){
			if($_POST){
				$data = array(
					'email' =>		$this->input->post('email'),
					'password' =>	$this->input->post('password')
				);
				$result = $this->Member_model->login($data);
				if($result != NULL){
					$result = $this->Member_model->member($result);
					if ($result != false) {
						if($result->active == 1){
							$session_data = array('id' => $result->id,'email' => $result->email);
							
							$this->Member_model->login_update($result->id, $result->total_login);
							$this->session->set_userdata('member_logged_in', $session_data);
							$this->session->set_flashdata("success_message", "Giriş başarılı!");
							redirect("/", 'refresh');
						}else{
							$this->session->set_flashdata("error_message", "Üyeliğiniz pasif durumdadır. Lütfen daha sonra tekrar deneyiniz.");
							redirect(site_url("giris-yap"), 'refresh');
						}
					}
				}else{
					$this->session->set_flashdata("error_message", "Hatalı kullanıcı adı & şifre kombinasyonu!");
					redirect(site_url("giris-yap"), 'refresh');
				}
			}else{
				$this->data['page']["title"] = "Üye Girişi";
				$this->load->view('member/login', $this->data);
			}
		}else{
			// Üye girişi yapılmışsa profil sayfasına yönlendiriliyor
			redirect(site_url("profilim"), 'refresh');
		}
	}

	public function signup()
	{
		if(! isset($this->session->userdata['member_logged_in'])){
			if($_POST){
				// Tüm mevcut üyelerin epostaları ile aynı olup olmadığını kontrol ediyor
				$control = 1;
				$members = $this->Member_model->get_member_session($this->input->post()["email"]);
				
				if(!$members){
					// Mail adresini bulamadı ise şifrelerin aynı olup olmadığını kontrol ediyor
					if($this->input->post()["password"] == $this->input->post()["password2"]){
						// Şifreler aynı ise üye kaydını yapıyor
						$this->Member_model->add_user($this->input->post());
						$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı! Giriş yapabilirsiniz.");
						redirect(site_url("giris-yap"), 'refresh');
					}else{
						// Şifreler aynı değil ise uyarı ile geri yönlendiriyor
						$this->session->set_flashdata("error_message", "Girdiğiniz şifreler birbiri ile eşleşmiyor. Lütfen kontrol edip tekrar deneyiniz.");
						redirect(site_url("uye-ol"), 'refresh');
					}
				}else{
					// Mail adresi mevcut ise uyarı ile geri yönlendiriyor
					$this->session->set_flashdata("error_message", "Mail adresiniz sistemimizde mevcut. Lütfen farklı bir mail adresi kullanın veya bizimle iletişime geçin.");
					redirect(site_url("uye-ol"), 'refresh');
				}
			}else{
				$this->data['page']["title"] = "Kayıt Ol";
				$this->load->view('member/signup', $this->data);
			}
		}else{
			// Üye girişi yapılmışsa profil sayfasına yönlendiriliyor
			redirect(site_url("profilim"), 'refresh');
		}
	}
	
	public function my_orders()
	{
		if(isset($this->session->userdata['member_logged_in'])){
			$this->data['page']["title"] = "Siparişlerim";
			$this->data["orders"] = $this->Member_model->orders();
			$this->load->view('member/my_orders', $this->data);
		}else{
			// Üye girişi yapılmamış ise giriş sayfasına yönlendiriliyor
			redirect(site_url("giris-yap"), 'refresh');
		}
	}

	public function my_favorite()
	{
		if(isset($this->session->userdata['member_logged_in'])){
			$this->data['page']["title"] = "Favorilerim";
			//$this->data["orders"] = $this->Member_model->orders();
			$this->load->view('member/my_orders', $this->data);
		}else{
			// Üye girişi yapılmamış ise giriş sayfasına yönlendiriliyor
			redirect(site_url("giris-yap"), 'refresh');
		}
	}

	public function forgot_password()
	{
		if(! isset($this->session->userdata['member_logged_in'])){
			if($_POST){
				$control = 0;
				$members = $this->Member_model->members();
				foreach($members as $item){
					if( $this->input->post()["email"] == $item->email ){ $control = 1; }
				}
				
				if($control == 1){
					$this->Member_model->create_secret_key($this->input->post()["email"]);
					$this->session->set_flashdata("success_message", "Şifre sıfırlama maili adresinize gönderilmiştir. Bağlantıyı tıklayarak şifrenizi sıfırlayabilirsiniz.");
					redirect(site_url("sifremi-unuttum"), 'refresh');
				}else{
					// Mail adresi mevcut değil ise uyarı ile geri yönlendiriyor
					$this->session->set_flashdata("error_message", "Girdiğiniz E-Mail ile ilgili bir üyelik sistemimizde mevcut değildir.");
					redirect(site_url("sifremi-unuttum"), 'refresh');
				}
			}else{
				$this->data['page']["title"] = "Şifremi Unuttum";
				$this->load->view('member/forgot_password', $this->data);
			}
		}else{
			// Üye girişi yapılmışsa profil sayfasına yönlendiriliyor
			redirect(site_url("profilim"), 'refresh');
		}
	}

	public function change_password()
	{
		if(isset($this->session->userdata['member_logged_in'])){
			if($_POST){
				if($this->input->post()["password"] == $this->input->post()["password2"]){

					$member = $this->Member_model->member($this->session->userdata['member_logged_in']['id']);
					if ($member->password != md5($this->input->post()["old_password"])) {
						$this->session->set_flashdata("error_message", "Eski şifrenizi hatalı girdiniz.! Lütfen tekrar deneyiniz.");
						redirect(site_url("sifre-degistir"), 'refresh');
					}

					$change = $this->Member_model->change_password($this->session->userdata['member_logged_in']['id'], $this->input->post()["password"]);
					if($change){
						$this->session->unset_userdata('member_logged_in');
						$this->session->set_flashdata("success_message", "Şifreniz başarı ile güncellenmiştir! Giriş yapabilirsiniz.");
						redirect(site_url("giris-yap"), 'refresh');
					}else{
						$this->session->set_flashdata("error_message", "Bir hata oluştu! Lütfen tekrar deneyiniz.");
						redirect(site_url("sifremi-unuttum"), 'refresh');
					}
				}else{
					$this->session->set_flashdata("error_message", "Girdiğiniz şifreler birbiri ile eşleşmiyor. Lütfen kontrol edip tekrar deneyiniz.");
					redirect($_SERVER['HTTP_REFERER']);
				}
			}else{
				$this->data['page']["title"] = "Şifremi Değiştir";
				$this->load->view('member/change_password', $this->data);
			}
		}else{
			if($_GET){
				//mert.yaman@egegen.coms
				$this->data['page']["title"] = "Şifremi Unuttum";
				$this->load->view('member/relog_password', $this->data);
			}else{
				redirect(site_url("giris-yap"), 'refresh');
			}
		}
	}
	
	public function relog_password()
	{
		if($_POST){
			if($this->input->post()["password"] == $this->input->post()["password2"]){
				$change = $this->Member_model->relog_password($this->input->post('sk'), $this->input->post()["password"]);
				if($change){
					$this->session->set_flashdata("success_message", "Şifreniz başarı ile güncellenmiştir! Giriş yapabilirsiniz.");
					redirect(site_url("giris-yap"), 'refresh');
				}else{
					$this->session->set_flashdata("error_message", "Bir hata oluştu! Lütfen tekrar deneyiniz.");
					redirect($_SERVER['HTTP_REFERER']);
				}
			}else{
				$this->session->set_flashdata("error_message", "Girdiğiniz şifreler birbiri ile eşleşmiyor. Lütfen kontrol edip tekrar deneyiniz.");
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			$this->data['page']["title"] = "Şifremi Unuttum";
			$this->load->view('member/change_password', $this->data);
		}
	}

	public function address_list()
	{
		if(isset($this->session->userdata['member_logged_in'])){

			$this->data["address_list"] = (array) $this->Member_model->address_list($this->session->userdata['member_logged_in']['id']);
			$this->data['page']["title"] = "Adres Listem";
			$this->load->view('member/address_list', $this->data);

		}else{
			redirect(site_url("giris-yap"), 'refresh');
		}
	}

	public function address_list_process()
	{
		if(isset($this->session->userdata['member_logged_in'])){
			$this->data['page']["title"] = "Adres Listem";
			$processType = $this->uri->segment(3);
			$memberId = $this->session->userdata['member_logged_in']['id'];
			$member = $this->Member_model->member($memberId);
			$this->data['member'] = $member;

			if ($processType == 'add') {
				if ($_POST) {
					$tcno = preg_replace("/[^0-9]/", "", $_POST['tcno']);
					if (strlen($tcno) != 11) {
						$this->session->set_flashdata("error_message", 'Geçersiz TC Kimlik Numarası.');
						redirect(site_url("adreslerim"));
					}

					$newAddress_id = $this->Member_model->newAddressAdd($memberId,$_POST);
					$this->session->set_flashdata("success_message", $_POST['title'].' İsimli adresiniz eklenmiştir.');
					redirect(site_url("adreslerim"), 'refresh');
				}
			}elseif($processType == 'update'){
				$address_id = $this->uri->segment(4);
				if ($_POST) {
					$tcno = preg_replace("/[^0-9]/", "", $_POST['tcno']);
					if (strlen($tcno) != 11) {
						$this->session->set_flashdata("error_message", 'Geçersiz TC Kimlik Numarası.');
						redirect(site_url("adreslerim"));
					}

					$this->Member_model->addressUpdate($memberId,$address_id,$_POST);
					$this->session->set_flashdata("alert",
						array(
							"statu" => "success",
							"title" => "Güncellendi.",
							"message" => $_POST['title'].' İsimli adresiniz güncellenmiştir.'
						)
					);
					redirect('/member/address_list_process/update/'.$address_id, 'refresh');
				}
				$this->data['member_address'] = $this->Member_model->get_address($memberId,$address_id);
			}elseif($processType == 'default'){

				$address_id = $this->uri->segment(4);
				$newAddressUpdate = $this->Member_model->addressDefault($memberId,$address_id);

				$this->session->set_flashdata("alert",
					array(
						"statu" => "success",
						"title" => "Güncellendi.",
						"message" => 'Berlitmiş olduğunuz adresiniz varsayılan adres olarak güncellenmiştir.'
					)
				);
				redirect(site_url("adreslerim"), 'refresh');

			}elseif ($processType == 'delete') {
				$address_id = $this->uri->segment(4);
				$this->Member_model->addressDelete($memberId,$address_id);

				$this->session->set_flashdata("alert",
					array(
						"statu" => "success",
						"title" => "Silindi",
						"message" => 'Belirttiğiniz adresiniz silinmiştir.'
					)
				);
				redirect(site_url("adreslerim"), 'refresh');
			}else{
				redirect(site_url("adreslerim"), 'refresh');
			}
			
			$this->load->view('member/address_list_process', $this->data);
		}else{
			// Üye girişi yapılmamış ise giriş sayfasına yönlendiriliyor
			redirect(site_url("giris-yap"), 'refresh');
		}
	}


	public function logout()
	{
		$this->session->unset_userdata('member_logged_in', array( 'email' => '' ));
		$this->session->set_flashdata("success_message", "Başarılı bir şekilde çıkış yapıldı.");
		redirect('/', 'refresh');
	}


	public function getLocation()
	{
		if ($_POST) {
			$post = $this->input->post();
			$response = (array) $this->Member_model->getLocation($post);
			echo json_encode($response);
		}
	}

	public function locationSelect()
	{
		if ($_POST) {
			$post = $this->input->post();
			$locationData = array(
				'city' 		=> $post['city'],
				'town' 		=> $post['town'],
				'district'	=> $post['district']
			);
			$this->session->set_userdata('locationData', $locationData);
			$regions = $this->Regions_model->get_regions();
			$arr_regions = array();
			foreach ($regions as $item) {
				if (@json_decode($item->district)) {
					foreach (json_decode($item->district) as $value) {
						if (@$value) {
							foreach ($value as $row) {
								if ($row==$post['district']) {
									array_push($arr_regions, $item);
								}
							}
						}
					}
				}
			}
			$branch_body = '';
			foreach ($arr_regions as $row) {
				$branch_body .= '
				<div class="col-12 col-md-6 col-lg-4 grid">
				<a href="'.($row->active==1 && date("H:i")>$row->open && date("H:i")<$row->close ? "member/branch/".$row->id:"javascript:;").'" class="branch-item">
				<div class="branch-item_body">
				<h3 class="branch-item_title">'.$row->title.'</h3>
				<span class="branch-item_area">'.str_replace(array("<p>","</p>"), "", $row->address).'</span>
				<span class="branch-item_date">Çalışma Saatleri : '.$row->open." - ".$row->close.'</span>
				<span class="branch-item_status-'.($row->active==1 && date("H:i")>$row->open && date("H:i")<$row->close ?"active":"passive").'">'.($row->active==1 && date("H:i")>$row->open && date("H:i")<$row->close ?"AÇIK":"KAPALI").'</span>
				</div>
				<svg class="icon icon-md color-secondary branch-item_icon">
				<use xlink:href="#icon-arrow-right-circle"></use>
				</svg>
				</a>
				</div>
				';
			}
			print_r($branch_body);exit;
		}else{
			redirect(base_url(), 'refresh');
		}
	}

	public function branch()
	{
		$branch_id = (int) $this->uri->segment(3);
		if (!$branch_id) redirect(base_url(), 'refresh');

		$region = (array) $this->Regions_model->record($branch_id);
		if ($region) {
			$branchData = array(
				'id' => $region["id"],
				'title' => $region["title"],
				'api_key' => $region["api_key"],
				'secret_key' => $region["secret_key"]
			);

			$this->session->set_userdata('branchData', $branchData);

			// şubenin minimum sipariş limiti kontrolü
			$district = $this->session->userdata("locationData")["district"];
			$region_info = $this->Regions_model->record($this->session->userdata("branchData")["id"])->district_min_order;
			$min_order = 0;
			foreach (json_decode($region_info) as $key => $value) {
				if ($key==$district) {
					$min_order = number_format($value,2);
				}
			}

			$this->session->set_flashdata("success_message", $branchData['title']." şube seçiminiz yapılmıştır. Seçmiş olduğunuz şubenin bulunduğunuz bölgeye minimum sipariş tutarı ".$min_order." TL'dir.");

			redirect(base_url('urunler'), 'refresh');
		}else{
			$this->session->set_flashdata("error_message", "Bir hata oluştu. Lütfen tekrar deneyin.");

			redirect(site_url(), 'refresh');
		}
		
	}
}