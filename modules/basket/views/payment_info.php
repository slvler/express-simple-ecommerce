<?php $this->load->view('home/layout/header'); ?>
<?php $this->load->view('search/search'); ?>
<?php
$this->load->helper('member/member');
$this->load->helper('campaign/campaign');
if ($this->session->userdata("member_logged_in")) {
    $member = get_member($this->session->userdata("member_logged_in")["id"]);
}
$campaign = campaigns(1);
$campaign_options = json_decode(campaigns(1)["options"]);
?>
<main id="main" class="main container">
    <h1 class="page-title subtitle">
        SİPARİŞ ONAYI VE ÖDEME
    </h1>
    <form action="<?php echo site_url("basket/payment"); ?>" id="formPCart" autocomplete="off" method="post" accept-charset="utf-8" novalidate="novalidate">
        <div class="row pt-2">
            <div class="col-12 col-lg-8">
                <?php if (@$this->session->userdata("member_logged_in")): ?>
                    <?php $address = get_member_address($this->session->userdata("member_logged_in")["id"]); ?>
                    <h3 class="color-secondary mb-2">
                        <svg class="icon icon-md mr-1">
                            <use xlink:href="#icon-map-marker"></use>
                        </svg>
                        Adres Seçimi
                    </h3>
                    <div class="card card-payment-address">
                        <div class="payment-address-list">
                            <p class="address-danger">Şube seçimi sırasında seçtiğiniz il,ilçe ve semt dışında bir adres seçimi yapılamamaktadır.</p>
                            <?php foreach ($address as $row): ?>
                                <div class="custom-control custom-radio payment-address-item">
                                    <input type="radio" name="address_id" class="custom-control-input" onclick="hideCollapse('#cllpAddressNews');" id="address_<?php echo $row->id; ?>" data-target="#cllapsNewAddressShipping" required="required" value="<?php echo $row->id; ?>" <?php echo ($row->city != $this->session->userdata("locationData")["city"] || $row->town != $this->session->userdata("locationData")["town"] || $row->district != $this->session->userdata("locationData")["district"])?'disabled':''; ?>> 
                                    <label class="custom-control-label" for="address_<?php echo $row->id; ?>">
                                        <p><?php echo $row->address." ".get_town_title($row->town)."/".get_city_title($row->city) ?></p>
                                    </label>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <div class="payment-address-add">
                            <a href="javascript:;" class="btn color-secondary py-2 px-0 btn-address-add" data-toggle="collapse" data-target="#cllpAddressNews">
                                <span class="btn-icon bg-secondary">
                                    <svg class="icon icon-sm">
                                        <use xlink:href="#icon-plus"></use>
                                    </svg>
                                </span>
                                <span class="btn-text">Yeni Adres</span>
                            </a>
                        </div>
                    </div>
                <?php endif ?>
                <div class="collapse <?php echo (@!$this->session->userdata("member_logged_in"))?'show':''; ?>" id="cllpAddressNews">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title  color-primary">
                                Teslimat Bilgileri
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 form-group">
                                    <label class="form-label">Adres Adı*</label>
                                    <input type="text" name="title" id="title" class="input" autocomplete="off" required="required">
                                </div>
                                <div class="col-6 form-group">
                                    <label class="form-label">TC No*</label>
                                    <input type="text" name="tcno" id="tcno" class="input" autocomplete="off" required="required"  minlength="11" maxlength="11" pattern="[0-9]*" onkeypress="return APP.isNumber(event)" value="<?php echo (@$member)?$member["tcno"]:''; ?>" >
                                </div>
                                <div class="col-6 form-group">
                                    <label class="form-label">Ad*</label>
                                    <input type="text" name="name" id="name" class="input" autocomplete="off" required="required" value="<?php echo (@$member)?$member["name"]:''; ?>">
                                </div>
                                <div class="col-6 form-group">
                                    <label class="form-label">Soyad*</label>
                                    <input type="text" name="surname" id="surname" class="input" autocomplete="off" required="required" value="<?php echo (@$member)?$member["surname"]:''; ?>">
                                </div>
                                <div class="col-12 col-md-6 form-group">
                                    <label class="form-label">E-posta*</label>
                                    <input type="email" name="email" id="email" class="input" autocomplete="off" required="required" value="<?php echo (@$member)?$member["email"]:''; ?>">
                                </div>
                                <div class="col-12 col-md-6 form-group">
                                    <label class="form-label">Telefon*</label>
                                    <input type="text" name="phone" id="phone" class="input mask" data-mask="phone" minlength="11" autocomplete="off" required="required" maxlength="16" value="<?php echo (@$member)?$member["phone"]:''; ?>">
                                </div>
                                <div class="col-12 col-md-4 form-group">
                                    <label class="form-label">Şehir*</label>
                                    <select class="input select location-address-select" write="town" required="required" id="city" name="city" readonly>
                                        <option value="<?php echo $this->session->userdata("locationData")["city"]; ?>"><?php echo get_city_title($this->session->userdata("locationData")["city"]); ?></option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4 form-group">
                                    <label class="form-label">İlçe*</label>
                                    <select class="input select location-address-select" write="district" required="required" id="town" name="town" readonly>
                                        <option value="<?php echo $this->session->userdata("locationData")["town"]; ?>"><?php echo get_town_title($this->session->userdata("locationData")["town"]); ?></option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4 form-group">
                                    <label class="form-label">Mahalle*</label>
                                    <select class="input select location-address-select" write="redirect" required="required" id="district" name="district" readonly>
                                        <option value="<?php echo $this->session->userdata("locationData")["district"]; ?>"><?php echo get_district_title($this->session->userdata("locationData")["district"]); ?></option>
                                    </select>
                                </div>
                                <div class="col-12 form-group">
                                    <label class="form-label">Adres*</label>
                                    <textarea name="address" id="address" class="input" autocomplete="off" required="required"></textarea>
                                </div>
                                <?php 
                                /*
                                <div class="col-12">
                                    <button type="submit" name="submit" class="btn btn-primary px-5">KAYDET</button>
                                </div>
                                */
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <h3 class="color-secondary mb-2">
                    <svg class="icon icon-md mr-1">
                        <use xlink:href="#icon-credit-cart"></use>
                    </svg>
                    Ödeme Şekli
                </h3>
                <div class="card card-payment-type">
                    <div class="payment-type-list accordion" data-radio="true" id="acc_payment">
                        <div class="acc acc--open">
                            <div class="acc-head">
                                <div class="custom-control custom-radio payment-address-item  acc-link"  data-target="#method1">
                                    <input type="radio" name="paymentmethod" class="custom-control-input" id="paymentmethod1" checked="checked" value="Online Kredi Kartı Ödeme" required="required"> 
                                    <label class="custom-control-label" for="paymentmethod1">
                                        <p>Online Ödeme</p>
                                    </label>
                                </div>
                            </div>
                            <div class="acc-body" id="method1">
                                <div class="acc-content">
                                    <div class="row">
                                        <div class="col-12 col-md-6 form-group">
                                            <label class="form-label">Kredi Kartı Numarası</label>
                                            <div class="card-type">
                                                <input type="text" name="cardno" value="" class="input input-with-shadow mask" id="cardno" placeholder="Kart Numarası" data-mask="card" autocomplete="off" minlength="19" maxlength="19" required="" inputmode="text">
                                                <span class="card-type_icon">
                                                    <img src="assets/img/mastercard.png" alt="mastercard" />
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label class="form-label">Adınız Soyadınız</label>
                                            <input type="text" name="cardname" value="" class="input input-with-shadow" id="cardname" autocomplete="off" required="">
                                        </div>  
                                        <div class="col-12 col-md-6">
                                            <div class="row">
                                                <div class="col-6 form-group">
                                                    <label class="form-label">Geçerlilik Tarihi (Ay/Yıl)</label>
                                                    <input type="text" name="carddate" value="" class="input input-with-shadow text-center mask" data-mask="card-date" id="carddate" autocomplete="off" required="" placeholder="00/00">
                                                </div> 
                                                <div class="col-6 form-group">
                                                    <label class="form-label">CCV/CVC</label>
                                                    <input type="text" name="ccv2" value="" class="input input-with-shadow text-center" id="ccv2" maxlength="3" onkeypress="return APP.isNumber(event)" autocomplete="off" required="" placeholder="000">
                                                </div> 
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php foreach ($payment_methods as $row): ?>
                            <div class="acc">
                                <div class="acc-head">
                                    <div class="custom-control custom-radio payment-address-item  acc-link">
                                        <input type="radio" name="paymentmethod" class="custom-control-input" id="paymentmethod<?php echo $row->id; ?>" value="<?php echo $row->title; ?>" required="required"> 
                                        <label class="custom-control-label" for="paymentmethod<?php echo $row->id; ?>">
                                            <p><?php echo $row->title; ?></p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="sticky">
                    <div class="card card-summary-product">
                        <div class="card-header">
                            <h4 class="card-title  color-primary">
                                <svg class="icon icon-md mr-2">
                                    <use xlink:href="#icon-cart"></use>
                                </svg>
                                Sepet Özetiniz
                            </h4>
                        </div>
                        <div class="card-body py-1">
                            <ul class="summary-product">
                                <?php foreach ($this->cart->contents() as $row): ?>
                                    <?php
                                    if ($row["list_img"]) {
                                        $img = $row["list_img"];
                                    }elseif (file_exists('upload/product_images/'.$row["prod_code"].'.jpg')) {
                                        $img = 'upload/product_images/'.$row["prod_code"].'.jpg';
                                    }else{
                                        $img = 'assets/img/ozsut.jpg';
                                    }
                                    $price = str_replace(",", "", $row["price"]) * $row["qty"];
                                    ?>
                                    <li>
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="<?php echo image_moo($img); ?>" class="summary-product__image" alt="<?php echo $row["title"]; ?>">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="summary-product__title">
                                                    <?php echo $row["title"]; ?>
                                                </h6>
                                                <p class="summary-product__info"><span><?php echo $row["qty"]; ?></span> x <span><?php echo $row["price"]; ?> TL</span>  </p>
                                            </div>
                                            <div class="summary-product__price"><?php echo number_format($price,2); ?> TL</div>
                                        </div>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <ul class="order-summary">
                                <?php $total_price = $this->cart->total(); ?>
                                <li>
                                    <span class="order-summary__label">Sepet Toplamı:</span>
                                    <span class="order-summary__price"><?php echo number_format($this->cart->total(),2); ?> TL</span>
                                </li>
                                <?php if ($campaign["active"]==1 && number_format($this->cart->total(),2) >= $campaign_options->order_price): ?>
                                    <?php
                                    $result = number_format($total_price,2) / $campaign_options->order_price;
                                    $discount_price = $campaign_options->discount_price * (int)$result;
                                    ?>
                                    <li>
                                        <span class="order-summary__label">İndirim Tutarınız:</span>
                                        <span class="order-summary__price"><?php echo number_format($discount_price,2); ?> TL</span>
                                    </li>
                                    <?php $total_price = $total_price - $discount_price; ?>
                                <?php endif ?>
                                <li class="order-summary__total">
                                    <span class="order-summary__label">Toplam Tutar:</span>
                                    <span class="order-summary__price"><?php echo number_format($total_price,2); ?> TL</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox"> <input type="checkbox" name="accept_kkvk" class="custom-control-input" id="accept_kkvk" required="required"> <label class="custom-control-label" for="accept_kkvk"><a href="javascript:;" class="mfp-btn" data-modal="#mdlkvkk">Kişisel verilerin kullanımı kanunu</a> bilgilendirme metnini okudum ve kabul ediyorum.</label> </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-basket-order">Ödemeyi Tamamla</button>
                </div>
            </div>
        </div>
    </form>
</main>
<?php $this->load->view('home/layout/footer'); ?>
<link rel="stylesheet" href="assets/css/basket.css" />
<script type="text/javascript">
    $(document).on("change", '.location-address-select', function() {
        var name = this.getAttribute('name'),
        write = this.getAttribute('write'),
        val = $(this).val(),
        data = '<option value="">Seçim Yapınız</option>';
        
        if (name == 'city') { $('#town').html(''); $('#district').html(''); }
        if (name == 'town') { $('#district').html(''); }

        if (write != 'redirect') {
            $.ajax({
                type: "post",
                url: "member/getLocation",
                data: "id=" + val + "&write=" + write + "&where=" + name,
                success: function(response) {
                    var obj = JSON.parse(response);
                    obj.forEach(function(object) {
                        data += '<option value="' + object.key + '">' + object.title + '</option>';
                    });
                    $('#' + write).html(data);
                }
            }); 
        }
    });
</script>