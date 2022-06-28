<?php $this->load->view('home/layout/header'); ?>

<?php $this->load->view('search/search'); ?>

<?php $this->load->helper('member/member'); ?>

<main id="main" class="main container">
    <h1 class="page-title subtitle">
        Profilim
    </h1>
    <div class="row pt-3">
        <?php $this->load->view('member/modules/sidebar'); ?>
        <div class="col-12 col-md-8 col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title color-primary">Adreslerim</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="formUpdateAccount" novalidate="novalidate">
                        <input type="hidden" name="default" value="<?php if($this->uri->segment(3) == 'update'){echo @$member_address->default;}else{echo '0';} ?>">
                        <div class="row">
                            <div class="col-6 form-group">
                                <label class="form-label">Adres Adı*</label>
                                <input type="text" name="title" id="title" class="input" value="<?php echo @$member_address->title; ?>" autocomplete="off" required="required">
                            </div>
                            <div class="col-6 form-group">
                                <label class="form-label">TC No*</label>
                                <input type="text" name="tcno" id="tcno" class="input" value="<?php echo @$member_address->tcno; ?>" autocomplete="off" required="required" minlenght="11" maxlenght="11">
                            </div>
                            <div class="col-6 form-group">
                                <label class="form-label">Ad*</label>
                                <input type="text" name="name" id="name" class="input" value="<?php echo @$member_address->name; ?>" autocomplete="off" required="required">
                            </div>
                            <div class="col-6 form-group">
                                <label class="form-label">Soyad*</label>
                                <input type="text" name="surname" id="surname" class="input" value="<?php echo @$member_address->surname; ?>" autocomplete="off" required="required">
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label class="form-label">E-posta*</label>
                                <input type="email" name="email" id="email" class="input" value="<?php echo @$member_address->email; ?>" autocomplete="off" required="required">
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label class="form-label">Telefon*</label>
                                <input type="text" name="phone" id="phone" class="input mask" data-mask="phone" minlength="11" value="<?php echo @$member_address->phone; ?>" autocomplete="off" required="required" maxlength="16">
                            </div>
                            <div class="col-12 col-md-4 form-group">
                                <label class="form-label">Şehir*</label>
                                <select class="input select location-address-select" write="town" required="required" id="city" name="city">
                                    <option value="">Seçim Seçiniz</option>
                                    <?php foreach (all_city() as $key => $value): ?>
                                        <option value="<?php echo $value->key; ?>" <?php echo(@$member_address->city == $value->key) ? 'selected' : ''; ?>><?php echo $value->title; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-12 col-md-4 form-group">
                                <label class="form-label">İlçe*</label>
                                <select class="input select location-address-select" write="district" required="required" id="town" name="town">
                                    <option value="">İl Seçiniz</option>
                                    <?php foreach (all_town(@$member_address->city) as $key => $value): ?>
                                        <option value="<?php echo $value->key; ?>" <?php echo(@$member_address->town == $value->key) ? 'selected' : ''; ?>><?php echo $value->title; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-12 col-md-4 form-group">
                                <label class="form-label">Mahalle*</label>
                                <select class="input select location-address-select" write="redirect" required="required" id="district" name="district">
                                    <option value="">İlçe Seçiniz</option>
                                    <?php foreach (all_district(@$member_address->town) as $key => $value): ?>
                                        <option value="<?php echo $value->key; ?>" <?php echo(@$member_address->district == $value->key) ? 'selected' : ''; ?>><?php echo $value->title; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-12 form-group">
                                <label class="form-label">Adres*</label>
                                <textarea name="address" id="address" class="input" autocomplete="off" required="required"><?php echo @$member_address->address; ?></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" name="submit" class="btn btn-primary px-5">KAYDET</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $this->load->view('home/layout/footer'); ?>
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