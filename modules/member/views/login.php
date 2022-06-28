<?php $this->load->view('home/layout/header'); ?>

<?php $this->load->view('search/search'); ?>

<main id="main" class="main container">
    <h1 class="page-title subtitle">
        Giriş
    </h1>
    <form action="member/login" id="formMember" class="text-center pt-3" autocomplete="off" method="post" accept-charset="utf-8" novalidate="novalidate">
        <div class="card card-member">
            <div class="card-header">
                <h4 class="card-title color-primary">Giriş</h4>
                <p class="card-header__text">Hoş geldiniz, lütfen hesabınıza giriş yapın.</p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="email" name="email" value="" class="input input-with-shadow" placeholder="E-posta Adresiniz" id="email" required="required">
                </div>
                <div class="form-group">
                    <input type="password" name="password" value="" class="input input-with-shadow" placeholder="Şifre" id="password" minlength="6" required="required">
                </div>
                <div class="grid-hor-center grid-justify-between form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" value="1" class="custom-control-input" id="check_remember">
                        <label class="custom-control-label" for="check_remember">Beni Hatırla</label>
                    </div>
                    <a href="<?php echo site_url("sifremi-unuttum"); ?>" class="link">Şifremi Unuttum?</a>
                </div>
                <div class="grid-hor-center grid-justify-between form-group">
                    <button type="submit" class="btn btn-primary btn-md">Giriş Yap</button>
                    <a href="<?php echo site_url("uye-ol"); ?>" class="btn btn-outline-secondary btn-md">Kayıt Ol</a>
                </div>
            </div>
        </div>
    </form> 
</main>

<?php $this->load->view('home/layout/footer'); ?>
<link rel="stylesheet" href="assets/css/basket.css" />
