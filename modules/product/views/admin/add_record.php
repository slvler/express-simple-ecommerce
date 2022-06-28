<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

<div class="row heading-bg">
	<div class="col-xs-12">
		<h5 class="txt-dark">Yeni Ürün Ekle</h5>
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
							<div  class="pills-struct">
								<ul role="tablist" class="nav nav-pills">
									<?php foreach(all_languages() as $item): ?>
										<li class="<?php echo($item->default == 1)?"active":""; ?>" role="presentation"><a aria-expanded="<?php echo($item->default == 1)?"true":"false"; ?>" data-toggle="tab" role="tab" href="#lang_<?php echo $item->lang ?>"><?php echo $item->language ?></a></li>
										<?php if($item->default == 1): ?><a href="<?php echo site_url('product/admin/index/'.(int)($this->uri->segment(4))); ?>" class="btn btn-xs btn-default pull-right" data-toggle="tooltip" title="Üst Sayfaya Git"><i class="fa fa-arrow-left"></i></a><?php endif; ?>
									<?php endforeach; ?>
								</ul>
								<div class="tab-content">
									<?php foreach(all_languages() as $item): ?>
										<div id="lang_<?php echo $item->lang ?>" class="tab-pane fade <?php echo($item->default == 1)?"active in":""; ?>" role="tabpanel">
											<div class="row">											
												<div class="col-md-9 col-xs-12">
													<div class="row">
														<div class="col-md-9 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[title]">Başlık</label>
																<input type="text" class="form-control" id="<?php echo $item->lang ?>[title]" name="<?php echo $item->lang ?>[title]" placeholder="İçerik Başlığı" <?php echo($item->default == 1)?'required="required"':""; ?> />
															</div>													
														</div>
														<div class="col-md-3 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[page_type]">Sayfa Türü</label>
																<select class="form-control" id="<?php echo $item->lang ?>[page_type]" name="<?php echo $item->lang ?>[page_type]" <?php echo($item->default == 1)?'required="required"':""; ?>>
																	<option value="" disabled selected class="hidden">Sayfa Türü Seçiniz</option>
																	<option value="category">Kategori</option>
																	<option value="product">Ürün</option>
																</select>
															</div>		
														</div>
													</div>
													<div class="row">
														<div class="col-md-6 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[list_img]">Görsel <small>(Listeleme)</small></label>
																<input type="file" class="form-control" id="<?php echo $item->lang ?>[list_img]" name="<?php echo $item->lang ?>_list_img" />
															</div>
														</div>
														<div class="col-md-6 col-xs-12">
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[header_img]">Görsel <small>(Üst)</small></label>
																<input type="file" class="form-control" id="<?php echo $item->lang ?>[header_img]" name="<?php echo $item->lang ?>_header_img" />
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[summary]">Özet</label>
														<textarea class="form-control" id="<?php echo $item->lang ?>[summary]" name="<?php echo $item->lang ?>[summary]" rows="3"></textarea>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[content]">İçerik</label>
														<textarea class="form-control tinymce" id="<?php echo $item->lang ?>[content]" name="<?php echo $item->lang ?>[content]"></textarea>
													</div>
													<hr />
													<div id="<?php echo $item->lang ?>_input_fields_wrap">
														<div class="row">
															<div class="col-xs-12">
																<label class="control-label mb-10 text-left">Ekstra Bilgiler</label>
																<a class="btn btn-xs btn-primary pull-right mb-15" id="<?php echo $item->lang ?>_add_field_button">Yeni Bilgi Ekle</a>
															</div>
														</div>
														<div class="row mb-15">
															<div class="col-md-11 col-xs-12">
																<div class="row">
																	<div class="col-md-3 col-xs-6">
																		<input type="text" class="form-control" name="<?php echo $item->lang ?>[extra][0][i0]" placeholder="Ölçü" />
																	</div>
																	<div class="col-md-3 col-xs-6">
																		<input type="text" class="form-control" name="<?php echo $item->lang ?>[extra][0][i1]" placeholder="Peşin Fiyatı" />
																	</div>
																	<div class="col-md-3 col-xs-6">
																		<input type="text" class="form-control" name="<?php echo $item->lang ?>[extra][0][i2]" placeholder="İndirimli Fiyatı" />
																	</div>
																	<div class="col-md-3 col-xs-6">
																		<input type="text" class="form-control" name="<?php echo $item->lang ?>[extra][0][i3]" placeholder="Taksit Fiyatı" />
																	</div>
																</div>
															</div>
															<div class="col-md-1 col-xs-12"></div>
														</div>
													</div>
													<hr />
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[gallery]">Foto Galeri <i class="fa fa-info-circle" data-toggle="tooltip" title="Yüklemek istediğiniz resimleri seçiniz veya sürükleyiniz. Çoklu seçim yapmak için 'ctrl' tuşunu kullanabilirsiniz."></i></label>
														<input type="file" class="form-control" id="<?php echo $item->lang ?>[gallery]" name="<?php echo $item->lang ?>_gallery[]" multiple />
													</div>
												</div>
												<div class="col-md-3 col-xs-12">	
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[description]">Sayfa Tanımı</label>
														<textarea class="form-control" id="<?php echo $item->lang ?>[description]" name="<?php echo $item->lang ?>[description]" placeholder="Sayfa Tanımı" rows="3"></textarea>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[keywords]">Anahtar Kelimeler</label>
														<textarea class="form-control" id="<?php echo $item->lang ?>[keywords]" name="<?php echo $item->lang ?>[keywords]" placeholder="Anahtar Kelimeler"></textarea>
													</div>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
							<div class="form-group clearfix">
								<button type="submit" class="btn btn-success pull-right">Kaydet</button>
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

<?php // Dinamik bilgi ekleme fonksiyonu ?>
<script>
	$(document).ready(function() {
		<?php foreach(all_languages() as $item): ?>		
			var i_<?php echo $item->lang ?> = 1;
			$("#<?php echo $item->lang ?>_add_field_button").click(function(e){
				e.preventDefault();
				$("#<?php echo $item->lang ?>_input_fields_wrap").append('<div class="row mb-15"><div class="col-md-11 col-xs-12"><div class="row"><div class="col-md-3 col-xs-6"><input type="text" class="form-control" name="<?php echo $item->lang ?>[extra]['+i_<?php echo $item->lang ?>+'][i0]" placeholder="Ölçü" /></div><div class="col-md-3 col-xs-6"><input type="text" class="form-control" name="<?php echo $item->lang ?>[extra]['+i_<?php echo $item->lang ?>+'][i1]" placeholder="Peşin Fiyatı" /></div><div class="col-md-3 col-xs-6"><input type="text" class="form-control" name="<?php echo $item->lang ?>[extra]['+i_<?php echo $item->lang ?>+'][i2]" placeholder="İndirimli Fiyatı" /></div><div class="col-md-3 col-xs-6"><input type="text" class="form-control" name="<?php echo $item->lang ?>[extra]['+i_<?php echo $item->lang ?>+'][i3]" placeholder="Taksit Fiyatı" /></div></div></div><div class="col-md-1 col-xs-12"><a class="btn btn-danger btn-square pt-10 pull-right" id="remove_field"><i class="ti-close"></i></a></div></div>');
				i_<?php echo $item->lang ?>++;
			});

			$("#<?php echo $item->lang ?>_input_fields_wrap").on("click","#remove_field", function(e){
				e.preventDefault(); $(this).parents('.row.mb-15').remove(); i_<?php echo $item->lang ?>--;
			});
		<?php endforeach; ?>
	});
</script>