<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>
<?php $this->load->helper('member/member'); ?>
	<div class="row heading-bg">
		<div class="col-xs-12">
			<h5 class="txt-dark">Üye Düzenle</h5>
		</div>
	</div>
	<?php if (!empty ($this->session->flashdata('success_message'))): ?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<i class="zmdi zmdi-check pr-15 pull-left"></i><p class="pull-left"><?php echo $this->session->flashdata('success_message'); ?></p> 
			<div class="clearfix"></div>
		</div>
	<?php endif; ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">			
					<div class="panel-body">
						<div class="form-wrap">
							<form method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-xs-12">
										<a href="<?php echo site_url('member/admin'); ?>" class="btn btn-xs btn-default pull-right" data-toggle="tooltip" title="Üst Sayfaya Git">
											<i class="fa fa-arrow-left"></i>
										</a>
									</div>
								</div>
								<div class="row mt-20">
									<div class="col-md-6 col-xs-12">
										<div class="table-responsive">
											<table class="table table-striped txt-dark">
												<tbody>
													<tr>
														<td><strong>Ad</strong></td>
														<td class="pt-0 pb-0"><input type="text" class="form-control" name="name" value="<?php echo @$page["name"] ?>" required="required" /></td>
													</tr>
													<tr>
														<td><strong>Soyad</strong></td>
														<td class="pt-0 pb-0"><input type="text" class="form-control" name="surname" value="<?php echo @$page["surname"] ?>" required="required" /></td>
													</tr>
													<tr>
														<td><strong>TC</strong></td>
														<td class="pt-0 pb-0"><input type="text" class="form-control" name="tcno" value="<?php echo @$page["tcno"] ?>" required="required" /></td>
													</tr>
													<tr>
														<td><strong>E-Posta</strong></td>
														<td class="pt-0 pb-0"><input type="email" class="form-control" name="email" value="<?php echo @$page["email"] ?>" required="required" /></td>
													</tr>
													<tr>
														<td><strong>Telefon</strong></td>
														<td class="pt-0 pb-0"><input type="text" class="form-control mask" name="phone" value="<?php echo @$page["phone"] ?>" pattern=".{16,16}" data-mask="9 (999) 999 9999" /></td>
													</tr>

													<tr>
														<td><strong>Üyelik Tarihi</strong></td>
														<td class="pt-0 pb-0"><input type="text" class="form-control" value="<?php echo @$page["created_date"] ?>" disabled /></td>
													</tr>
													<tr>
														<td><strong>Son Giriş</strong></td>
														<td class="pt-0 pb-0"><input type="text" class="form-control" value="<?php echo @$page["last_login"] ?>" disabled /></td>
													</tr>
													<tr>
														<td><strong>Toplam Giriş</strong></td>
														<td class="pt-0 pb-0"><input type="text" class="form-control" value="<?php echo @$page["total_login"] ?>" disabled /></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-md-6 col-xs-12">
										<div class="form-group">
											<label class="control-label mb-10 text-left" for="password">Yeni Şifre</label>
											<input type="password" class="form-control" id="password" name="password" placeholder="Yeni bir şifre belirleyin" pattern=".{6,}" title="minimum 6 karakter" />
										</div>
										<div class="form-group clearfix">
											<button type="submit" class="btn btn-success pull-right">Kaydet</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php $this->load->view('admin/layout/footer'); ?>
<?php $this->load->view('admin/layout/end'); ?>

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