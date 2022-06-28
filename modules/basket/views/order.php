<?php $this->load->view('home/layout/header'); ?>
<?php $this->load->view('search/search'); ?>

<main id="main" class="main container">
    <h1 class="page-title subtitle">
        SİPARİŞ ONAYI VE ÖDEME
    </h1>
    <form action="basket/update" id="formPCart" autocomplete="off" method="post" accept-charset="utf-8" novalidate="novalidate">
        <div class="row pt-2">
            <div class="col-12 col-lg-8">
                <h3 class="color-secondary mb-2">
                    <svg class="icon icon-md mr-1">
                        <use xlink:href="#icon-map-marker"></use>
                    </svg>
                    Adres Seçimi
                </h3>
                <div class="card card-payment-address">
                    <div class="payment-address-list">
                        <div class="custom-control custom-radio payment-address-item">
                            <input type="radio" name="address_shipping" class="custom-control-input" onclick="hideCollapse('#cllpAddressNews');" id="address_shipping_1" value="new" data-target="#cllapsNewAddressShipping" required="required"> 
                            <label class="custom-control-label" for="address_shipping_1">
                                <p>Mansuroğlu, Ankara Cd.  No:119, 35535 Bayraklı/İzmir</p>
                            </label>
                        </div>
                        <div class="custom-control custom-radio payment-address-item">
                            <input type="radio" name="address_shipping" class="custom-control-input" onclick="hideCollapse('#cllpAddressNews');" id="address_shipping_2" value="new" data-target="#cllapsNewAddressShipping" required="required"> 
                            <label class="custom-control-label" for="address_shipping_2">
                                <p>Mansuroğlu, Ankara Cd.  No:119, 35535 Bayraklı/İzmir</p>
                            </label>
                        </div>
                    </div>
                    <div class="payment-address-add">
                        <a href="javascript:;" class="btn color-secondary py-2 px-0 btn-address-add" data-toggle="collapse" data-target="#cllpAddressNews">
                            <span class="btn-icon bg-secondary">
                                <svg class="icon icon-sm">
                                    <use xlink:href="#icon-plus"></use>
                                </svg>
                            </span>
                            <span class="btn-text">Adres Ekle</span>
                        </a>
                    </div>
                </div>
                <div class="collapse" id="cllpAddressNews">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title  color-primary">
                                Teslimat Bilgileri
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                        <input type="hidden" name="shipping[type]" value="Teslimat Adresi"> 
                                        <div class="col-12 form-group">
                                            <label class="form-label">Adres Başlığı*</label>
                                            <input type="text" name="shipping[name]" class="input input-with-shadow" id="order_name" required="required">
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label class="form-label">Adınız Soyadınız*</label>
                                            <input type="text" name="shipping[fullname]" class="input input-with-shadow" id="order_fullname" required="required">
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label class="form-label">Telefon*</label>
                                            <input type="text" name="shipping[phone]" class="input input-with-shadow mask" id="phone" data-mask="phone" required="required" autocomplete="off" maxlength="16" inputmode="text">
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label class="form-label" for="shipping_city">Şehir*</label> 
                                            <select class="input input-with-shadow select location-select" data-source="city" select-type="shipping" write="town" id="shipping_city" name="shipping[city]" required="required">
                                                <option value="">Şehir Seçiniz</option>
                                                <option value="1">Adana</option>
                                                <option value="2">Adıyaman</option>
                                                <option value="3">Afyon</option>
                                                <option value="4">Ağrı</option>
                                                <option value="5">Amasya</option>
                                                <option value="6">Ankara</option>
                                                <option value="7">Antalya</option>
                                                <option value="8">Artvin</option>
                                                <option value="9">Aydın</option>
                                                <option value="10">Balıkesir</option>
                                                <option value="11">Bilecik</option>
                                                <option value="12">Bingöl</option>
                                                <option value="13">Bitlis</option>
                                                <option value="14">Bolu</option>
                                                <option value="15">Burdur</option>
                                                <option value="16">Bursa</option>
                                                <option value="17">Çanakkale</option>
                                                <option value="18">Çankırı</option>
                                                <option value="19">Çorum</option>
                                                <option value="20">Denizli</option>
                                                <option value="21">Diyarbakır</option>
                                                <option value="22">Edirne</option>
                                                <option value="23">Elazığ</option>
                                                <option value="24">Erzincan</option>
                                                <option value="25">Erzurum</option>
                                                <option value="26">Eskişehir</option>
                                                <option value="27">Gaziantep</option>
                                                <option value="28">Giresun</option>
                                                <option value="29">Gümüşhane</option>
                                                <option value="30">Hakkari</option>
                                                <option value="31">Hatay</option>
                                                <option value="32">Isparta</option>
                                                <option value="33">İçel</option>
                                                <option value="34">İstanbul</option>
                                                <option value="35">İzmir</option>
                                                <option value="36">Kars</option>
                                                <option value="37">Kastamonu</option>
                                                <option value="38">Kayseri</option>
                                                <option value="39">Kırklareli</option>
                                                <option value="40">Kırşehir</option>
                                                <option value="41">Kocaeli</option>
                                                <option value="42">Konya</option>
                                                <option value="43">Kütahya</option>
                                                <option value="44">Malatya</option>
                                                <option value="45">Manisa</option>
                                                <option value="46">Kahramanmaraş</option>
                                                <option value="47">Mardin</option>
                                                <option value="48">Muğla</option>
                                                <option value="49">Muş</option>
                                                <option value="50">Nevşehir</option>
                                                <option value="51">Niğde</option>
                                                <option value="52">Ordu</option>
                                                <option value="53">Rize</option>
                                                <option value="54">Sakarya</option>
                                                <option value="55">Samsun</option>
                                                <option value="56">Siirt</option>
                                                <option value="57">Sinop</option>
                                                <option value="58">Sivas</option>
                                                <option value="59">Tekirdağ</option>
                                                <option value="60">Tokat</option>
                                                <option value="61">Trabzon</option>
                                                <option value="62">Tunceli</option>
                                                <option value="63">Şanlıurfa</option>
                                                <option value="64">Uşak</option>
                                                <option value="65">Van</option>
                                                <option value="66">Yozgat</option>
                                                <option value="67">Zonguldak</option>
                                                <option value="68">Aksaray</option>
                                                <option value="69">Bayburt</option>
                                                <option value="70">Karaman</option>
                                                <option value="71">Kırıkkale</option>
                                                <option value="72">Batman</option>
                                                <option value="73">Şırnak</option>
                                                <option value="74">Bartın</option>
                                                <option value="75">Ardahan</option>
                                                <option value="76">Iğdır</option>
                                                <option value="77">Yalova</option>
                                                <option value="78">Karabük</option>
                                                <option value="79">Kilis</option>
                                                <option value="80">Osmaniye</option>
                                                <option value="81">Düzce</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label class="form-label" for="shipping_town">İlçe*</label> 
                                            <select class="input select input-with-shadow location-select" data-source="town" select-type="shipping" id="shipping_town" name="shipping[town]" required="required">
                                                <option value="">İlçe Seçiniz</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label class="form-label" for="shipping_neighborhood">Mahalle*</label> 
                                            <select class="input select input-with-shadow location-select" data-source="neighborhood" select-type="shipping" id="shipping_neighborhood" name="shipping[neighborhood]" required="required">
                                                <option value="">Mahalle Seçiniz</option>
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label class="form-label" for="shipping_address">Adres*</label>
                                            <textarea name="shipping[address]" class="input input-with-shadow textarea" id="shipping_address" required="required" value=""></textarea>
                                        </div>
                                       
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
                                    <input type="radio" name="paymentmethod" class="custom-control-input" id="paymentmethod1" checked="checked" value="Online Ödeme" required="required"> 
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
                                                    <input type="text" name="carddate" value="" class="input input-with-shadow text-center mask" data-mask="card-date" id="carddate" min="4" autocomplete="off" required="" placeholder="00/00">
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
                        <div class="acc">
                            <div class="acc-head">
                                <div class="custom-control custom-radio payment-address-item  acc-link">
                                    <input type="radio" name="paymentmethod" class="custom-control-input" id="paymentmethod2" value="Kapıda Ödeme Kredi Kartı" required="required"> 
                                    <label class="custom-control-label" for="paymentmethod2">
                                        <p>Kapıda Ödeme Kredi Kartı</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="acc">
                            <div class="acc-head">
                                <div class="custom-control custom-radio payment-address-item  acc-link">
                                    <input type="radio" name="paymentmethod" class="custom-control-input" id="paymentmethod3" value="Kapıda Ödeme Nakit" required="required"> 
                                    <label class="custom-control-label" for="paymentmethod3">
                                        <p>Kapıda Ödeme Nakit</p>
                                    </label>
                                </div>
                            </div>
                        </div>
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
                                    <li>
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="upload/urun1.jpg" class="summary-product__image" alt="">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="summary-product__title">
                                                    KARAORMAN KROKAN
                                                </h6>
                                                <p class="summary-product__info"><span>2</span> x <span>7,5 TL</span>  </p>
                                            </div>
                                            <div class="summary-product__price">3.500 TL</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="upload/urun1.jpg" class="summary-product__image" alt="">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="summary-product__title">
                                                    KARAORMAN KROKAN
                                                </h6>
                                                <p class="summary-product__info"><span>2</span> x <span>7,5 TL</span>  </p>
                                            </div>
                                            <div class="summary-product__price">3.500 TL</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                    </div>
                    <div class="card">
                            <div class="card-body">
                                <ul class="order-summary">
                                    <li>
                                        <span class="order-summary__label">Tutar:</span>
                                        <span class="order-summary__price">50 TL</span>
                                    </li>
                                    <li>
                                        <span class="order-summary__label">İndirim Tutarınız:</span>
                                        <span class="order-summary__price">10 TL</span>
                                    </li>
                                    <li>
                                        <span class="order-summary__label">Kargo:</span>
                                        <span class="order-summary__price">10 TL</span>
                                    </li>
                                    <li>
                                        <span class="order-summary__label">KDV:</span>
                                        <span class="order-summary__price">10 TL</span>
                                    </li>
                                    <li class="order-summary__total">
                                        <span class="order-summary__label">Sepet Toplamı:</span>
                                        <span class="order-summary__price">60 TL</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-basket-order">Ödemeyi Tamamla</button>
                </div>
            </div>
        </div>
    </form>
</main>
<?php $this->load->view('home/layout/footer'); ?>
<link rel="stylesheet" href="assets/css/basket.css" />