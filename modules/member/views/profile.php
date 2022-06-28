<?php $this->load->view('home/layout/header'); ?>

<?php $this->load->view('search/search'); ?>

<main id="main" class="main container">
    <h1 class="page-title subtitle">
        Profilim
    </h1>
    <div class="row pt-3">

    	<?php $this->load->view('member/modules/sidebar'); ?>

        <div class="col-12 col-md-8 col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title color-primary">Hesap Bilgilerim</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="formUpdateAccount" novalidate="novalidate">
                        <div class="row">
                            <div class="col-12 form-group">
                                <label class="form-label">TC. Kimlik No</label>
                                <input type="text" name="tcno" id="tcno" class="input" value="<?php echo $record->tcno; ?>" autocomplete="off" required="required" pattern="[a-zA-Z]+" minlenght="11" maxlength="11">
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label class="form-label">Ad*</label>
                                <input type="text" name="name" id="name" class="input " value="<?php echo $record->name; ?>" autocomplete="off" required="required" pattern="[a-zA-Z]+" maxlength="50" readonly>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label class="form-label">Soyad*</label>
                                <input type="text" name="surname" id="surname" class="input " value="<?php echo $record->surname; ?>" autocomplete="off" required="required" pattern="[a-zA-Z]+" maxlength="50" readonly>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label class="form-label">E-posta*</label>
                                <input type="email" name="email" id="email" class="input" value="<?php echo $record->email; ?>" autocomplete="off" required="required" readonly>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label class="form-label">Telefon*</label>
                                <input type="text" name="phone" id="phone" class="input mask" data-mask="phone" minlength="11" value="<?php echo $record->phone; ?>" autocomplete="off" required="required" maxlength="16">
                            </div>
                            <div class="col-12 form-group">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" name="campaign" class="custom-control-input" value="1" id="campaign" <?php echo ($record->campaign == 1) ? 'checked':''; ?>>
                                    <label class="custom-control-label" for="campaign">Kampanya, duyuru, bilgilendirmelerden e-posta ile haberdar olmak istiyorum.</label>
                                </div>
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
