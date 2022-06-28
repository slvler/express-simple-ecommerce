<?php $this->load->view('home/layout/header'); ?>

<?php $this->load->view('search/search'); ?>

<main id="main" class="main container">
    <h1 class="page-title subtitle">
        Giriş
    </h1>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title color-primary">Şifre Değiştir</h4>
        </div>
        <div class="card-body">
            <form action="member/relog_password" method="post" id="formUpdateAccount" novalidate="novalidate">
                <div class="row">
                    <input type="hidden" name="sk" value="<?php echo $_GET['sk'] ?>">
                    <div class="col-12 col-md-6 form-group">
                        <label class="form-label">Yeni Şifre*</label>
                        <input type="password" name="password" id="password" class="input" minlength="6" value="" data="" autocomplete="off" required="required">
                    </div>
                    <div class="col-12 col-md-6 form-group">
                        <label class="form-label">Yeni Şifre Tekrar*</label>
                        <input type="password" name="password2" id="password2" class="input" data-rule-equalto="#password" minlength="6" value="" data="" autocomplete="off" required="required">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-5">KAYDET</button>
                    </div>
                </div>
            </form>
        </div>
    </div> 
</main>      

<?php $this->load->view('home/layout/footer'); ?>

<link rel="stylesheet" href="assets/css/basket.css" />