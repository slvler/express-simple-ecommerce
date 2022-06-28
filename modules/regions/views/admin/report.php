<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>
<?php $this->load->helper('member/member'); ?>
<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h5 class="txt-dark"><?php echo $region->title; ?> Şubesi Sipariş Raporu</h5>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
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
	<div class="col-xs-12">
		<div class="panel panel-default card-view">	
			<div class="panel-body">
				<h6 class="mb-15"><?php echo $region->title; ?> Şubesi Toplam Tutarlar</h6>
				<div class="table-wrap">
					<div class="table-responsive">
						<div class="order-price col-xs-12 text-center">
							<div class="col-md-3">
								<p>Toplam Sipariş Tutarı</p>
								<p><?php echo $total_order_price; ?> TL</p>
							</div>
							<div class="col-md-3">
								<p>Toplam İndirim Tutarı</p>
								<p><?php echo $total_order_discount_price; ?> TL</p>
							</div>
							<div class="col-md-3">
								<p>Toplam Şube İndirim Tutarı</p>
								<p><?php echo $total_order_discount_price / 2; ?> TL</p>
							</div>
							<div class="col-md-3">
								<p>Toplam Özsüt İndirim Tutarı</p>
								<p><?php echo $total_order_discount_price / 2; ?> TL</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="panel panel-default card-view">
			<div class="panel-wrapper collapse in">			
				<div class="panel-body">
					<div class="table-wrap">
						<div class="table-responsive">
							<table class="table table-hover mb-0">
								<thead>
									<tr>
										<th>Sipariş Numarası</th>
										<th>Ödeme</th>
										<th>Tarih</th>
										<th>Durum</th>
										<th>Tutar</th>
										<th>İndirim Tutarı</th>
										<th>Şube Tutarı</th>
										<th>Özsüt Tutarı</th>
										<th>İşlemler</th>
									</tr>
								</thead>
								<tbody id="sortable">
									<?php foreach ($orders as $item): ?>										
										<tr id="listItem_<?php echo $item->id; ?>">
											<td><?php echo $item->order_key; ?></td>
											<td><?php echo $item->payment_status; ?></td>
											<td><?php echo $item->date; ?></td>
											<td><?php echo $item->status; ?></td>
											<td><?php echo $item->total; ?> ₺</td>
											<td><?php echo $item->discount_price; ?> ₺</td>
											<td><?php echo $item->discount_price / 2; ?> ₺</td>
											<td><?php echo $item->discount_price / 2; ?> ₺</td>
											<td>
												<a href="<?php echo site_url("regions/admin/report_detail/".$item->id); ?>" class="btn btn-xs btn-info" data-toggle="tooltip" title="Detay Görüntüle"><i class="fa fa-eye"></i></a>	
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
