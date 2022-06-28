<?php $this->load->view('home/layout/header'); ?>

<?php $this->load->view('search/search'); ?>

<main id="main" class="main container">
    <h1 class="page-title subtitle">
        Giriş
    </h1>
    <form action="" id="formMember" class="text-center pt-3" autocomplete="off" method="post" accept-charset="utf-8" novalidate="novalidate">
        <div class="card card-member">
            <div class="card-header">
                <h4 class="card-title color-primary">Şifremi Unuttum</h4>
                <p class="card-header__text">Yeni şifre belirlemek için kayıtlı e-posta adresinizi yazınız. Şifre değiştirme linkini e-posta adresinize göndereceğiz.</p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="email" name="email" value="" class="input input-with-shadow" placeholder="E-posta Adresiniz" id="email" required="required">
                </div>
                <div class="grid-hor-center grid-justify-between form-group">
                    <button type="submit" class="btn btn-primary btn-md">Talep Oluştur</button>
                    <a href="<?php echo site_url("giris-yap"); ?>" class="btn btn-outline-secondary btn-md">Giriş Yap</a>
                </div>
            </div>
        </div>
    </form> 
</main>      

<?php $this->load->view('home/layout/footer'); ?>

<link rel="stylesheet" href="assets/css/basket.css" />