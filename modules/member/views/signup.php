<?php $this->load->view('home/layout/header'); ?>

<?php $this->load->view('search/search'); ?>

<main id="main" class="main container">
    <h1 class="page-title subtitle">
        Aramıza Katıl
    </h1>
    <form action="member/signup" id="formMember" class="text-center pt-3" autocomplete="off" method="post" accept-charset="utf-8" novalidate="novalidate">
        <div class="card card-member">
            <div class="card-header">
                <h4 class="card-title color-primary">Kayıt Ol</h4>
                <p class="card-header__text">Özsüt'ün yenilenen lezzetlerini ve taze tatlarını kaçırma.</p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="text" name="name" value="" class="input input-with-shadow" placeholder="Adınız" id="name" required="required">
                </div>
                <div class="form-group">
                    <input type="text" name="surname" value="" class="input input-with-shadow" placeholder="Soyadınız" id="surname" required="required">
                </div>
                <div class="form-group">
                    <input type="text" name="tcno" value="" class="input input-with-shadow" placeholder="TC Kimlik Numaranız" id="tcno" required="required"  minlength="11" maxlength="11" pattern="[0-9]*" onkeypress="return APP.isNumber(event)" >
                </div>
                <div class="form-group">
                    <input type="email" name="email" value="" class="input input-with-shadow" placeholder="E-posta" id="email" required="required">
                </div>
                <div class="form-group">
                    <input type="password" name="password" value="" class="input input-with-shadow" placeholder="Şifre" id="password" minlength="6" required="required">
                </div>
                <div class="form-group">
                    <input type="password" name="password2" value="" class="input input-with-shadow" placeholder="Şifre Tekrar" id="password2" minlength="6" required="required">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="accept_kkvk" class="custom-control-input" id="accept_kkvk" required="required">
                        <label class="custom-control-label" for="accept_kkvk"><a href="javascript:;" class="mfp-btn" data-modal="#mdlkvkk">Kişisel verilerin kullanımı kanunu</a> bilgilendirme metnini okudum ve kabul ediyorum.</label>
                    </div>
                </div>
                <div class="grid-hor-center grid-justify-between form-group">
                    <button type="submit" class="btn btn-primary btn-md">Aramıza Katıl</button>
                    <a href="<?php echo site_url("giris-yap"); ?>" class="btn btn-outline-secondary btn-md">Giriş Yap</a>
                </div>
            </div>
        </div>
    </form> 
</main>      

<?php $this->load->view('home/layout/footer'); ?>

<link rel="stylesheet" href="assets/css/basket.css" />
