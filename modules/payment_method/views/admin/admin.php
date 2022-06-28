<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>
<?php $this->load->helper('member/member'); ?>
<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h5 class="txt-dark">Ödeme Methodları</h5>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<?php if (@!$this->session->userdata("logged_in")["type"]=="region"): ?>
			<a href="<?php echo site_url('payment_method/admin/add_record'); ?>" class="btn btn-primary btn-xs pull-right">Yeni Kayıt</a>
		<?php endif ?>
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
					<div class="table-wrap">
						<div class="table-responsive">
							<table class="table table-hover mb-0">
								<thead>
									<tr>
										<th>#</th>
										<th>Method Adı</th>
										<th>Aktif</th>
										<?php if (@!$this->session->userdata("logged_in")["type"]=="region"): ?>
											<th>İşlemler</th>
										<?php endif ?>
									</tr>
								</thead>
								<tbody id="sortable">
									<?php foreach ($page as $item): ?>										
										<tr id="listItem_<?php echo $item->id; ?>">
											<td><?php echo $item->id; ?></td>
											<td><?php echo $item->title; ?></td>
											<?php if (@!$this->session->userdata("logged_in")["type"]=="region"): ?>
												<td><input type="checkbox" onchange="window.location.href='<?php echo site_url("payment_method/admin/change_active/".$item->id."/".$item->active); ?>'" class="js-switch js-switch-1" <?php echo($item->active == 1)?'checked="checked"':""; ?> data-color="#469408" data-size="small"/></td>
												<?php else: ?>
													<?php
													// methodun şubede aktiflik durumu kontrol ediliyor.
													$this->load->helper('product/product');
													$region_invisible_payment_method = get_region()["invisible_payment_method"];
													$control = 0;
													if ($region_invisible_payment_method) {
														foreach (json_decode($region_invisible_payment_method) as $row) {
															if ($row==$item->id) {
																$control=1;
															}
														}
													}
													?>
													<td><input type="checkbox" onchange="window.location.href='<?php echo site_url("payment_method/admin/change_active_region/".$item->id."/".$control); ?>'" class="js-switch js-switch-1" <?php echo($control == 0)?'checked="checked"':""; ?> data-color="#469408" data-size="small"/></td>
												<?php endif ?>
												<?php if (@!$this->session->userdata("logged_in")["type"]=="region"): ?>
													<td>
														<a href="<?php echo site_url('payment_method/admin/edit_record/'.$item->id); ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Düzenle"><i class="fa fa-pencil"></i></a>
														<a onclick="delete_confirm('<?php echo site_url('payment_method/admin/delete_record/'.$item->id); ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Sil"><i class="fa fa-trash"></i></a>
													</td>
												<?php endif ?>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php $this->load->view('admin/layout/footer'); ?>
	<?php $this->load->view('admin/layout/end'); ?>