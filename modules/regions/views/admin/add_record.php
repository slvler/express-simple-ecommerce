<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

<div class="row heading-bg">
	<div class="col-xs-12">
		<h5 class="txt-dark">Yeni Şube Ekle</h5>
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
								<div class="tab-content">
									<div id="lang" class="tab-pane fade active in" role="tabpanel">
										<div class="row">											
											<div class="col-md-9 col-xs-12">
												<div class="row">
													<div class="col-xs-12 col-md-4">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="title">Şube Adı</label>
															<input type="text" class="form-control" id="title" name="title" placeholder="Şube Adı" required="required" />
														</div>
													</div>
													<div class="col-xs-12 col-md-4">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="email">Şube E-posta</label>
															<input type="text" class="form-control" id="email" name="email" placeholder="Şube E-posta" required="required" />
														</div>
													</div>
													<div class="col-xs-12 col-md-4">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="phone">Şube Telefon</label>
															<input type="text" class="form-control" id="phone" name="phone" placeholder="Şube Telefon" required="required" />
														</div>
													</div>
													<div class="col-xs-12 col-md-6">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="open">Şube Açılış Saati</label>
															<input type="time" class="form-control" id="open" name="open" placeholder="Şube Açılış Saati" required="required" />
														</div>
													</div>
													<div class="col-xs-12 col-md-6">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="close">Şube Kapanış Saati</label>
															<input type="time" class="form-control" id="close" name="close" placeholder="Şube Kapanış Saati" required="required" />
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label mb-10 text-left" for="address">Şube Adresi</label>
													<textarea class="form-control tinymce" id="address" name="address"></textarea>
												</div>
											</div>					
											<div class="col-md-3 col-xs-12"></div>
										</div>
									</div>
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