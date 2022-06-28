<?php $this->load->view('home/layout/header'); ?>

<?php $this->load->view('search/search'); ?>

<main id="main" class="main container">
    <h1 class="page-title subtitle">
        <?php echo $page["title"]; ?>
    </h1>
    <div class="row pt-3">
        <?php $this->load->view('member/modules/sidebar'); ?>

        <div class="col-12 col-md-8 col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title color-primary"><?php echo $page["title"]; ?></h4>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="formUpdateAccount" novalidate="novalidate">
                        <div class="row">
                            <div class="col-12 col-12 form-group">
                                <label class="form-label">Eski Şifre*</label>
                                <input type="password" name="old_password" id="old_password" class="input" minlength="6" value="" data="" autocomplete="off" required="required">
                            </div>
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
        </div>
    </div>
</main>      


<?php $this->load->view('home/layout/footer'); ?>