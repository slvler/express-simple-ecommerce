<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>
<?php $this->load->helper('member/member'); ?>
<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h5 class="txt-dark">Şubeler</h5>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<a href="<?php echo site_url('regions/admin/add_record'); ?>" class="btn btn-primary btn-xs pull-right">Yeni Kayıt</a>
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
										<th>Şube Adı</th>
										<th>Şehir</th>
										<th>Aktif</th>
										<th>İşlemler</th>
									</tr>
								</thead>
								<tbody id="sortable">
									<?php foreach ($page as $item): ?>										
										<tr id="listItem_<?php echo $item->id; ?>">
											<td><?php echo $item->id; ?></td>
											<td><?php echo $item->title; ?></td>
											<td><?php echo get_city_title(@$item->city); ?></td>
											<td><input type="checkbox" onchange="window.location.href='<?php echo site_url("regions/admin/change_active/".$item->id."/".$item->active); ?>'" class="js-switch js-switch-1" <?php echo($item->active == 1)?'checked="checked"':""; ?> data-color="#469408" data-size="small"/></td>
											<td>
												<a href="<?php echo site_url('regions/admin/edit_record/'.$item->id); ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Düzenle"><i class="fa fa-pencil"></i></a>
												<?php if ($item->city): ?>
													<a href="<?php echo site_url('regions/admin/edit_regions?city='.$item->city.'&regions_id='.$item->id); ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Şube Bölgelerini Düzenle"><i class="fa fa-building"></i></a>
													<a href="<?php echo site_url('regions/admin/update_min_order/'.$item->id); ?>" class="btn btn-xs btn-success" data-toggle="tooltip" title="Şube Bölgelerinin Minimum Sipariş Tutarları"><i class="fa fa-money"></i></a>
													<?php else: ?>
														<a href="<?php echo site_url('regions/admin/add_regions/'.$item->id); ?>" class="btn btn-xs btn-success" data-toggle="tooltip" title="Şube Bölgeleri Ekle"><i class="fa fa-building"></i></a>
													<?php endif ?>
													<!-- <a href="<?php echo site_url('regions/admin/report/'.$item->id); ?>" class="btn btn-xs btn-success" data-toggle="tooltip" title="Şube Raporu" style="background: #179800;border: 1px solid #179800;"><i class="fa fa-bar-chart"></i></a> -->
													<a onclick="delete_confirm('<?php echo site_url('regions/admin/delete_record/'.$item->id); ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Sil"><i class="fa fa-trash"></i></a>
												</td>
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
