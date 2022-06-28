<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h5 class="txt-dark">Siparişler</h5>
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
							<table class="table mb-0 table-hover display dataTable" id="datable_1">
								<thead>
									<tr>
										<th>Sipariş Numarası</th>
										<th>Ad Soyad</th>
										<th>E-posta</th>
										<th>Tutar</th>
										<th>Ödeme</th>
										<th>Ödeme Durumu</th>
										<th>Tarih</th>
										<th>Durum</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($order as $item): ?>										
										<?php if ($item["status"]=="Onaylanmamış"): ?>
											<tr>
												<td><?php echo $item["order_key"]; ?></td>
												<td><?php echo $item["name"]." ".$item["surname"]; ?></td>
												<td><?php echo $item["email"]; ?></td>
												<td><?php echo $this->cart->format_number($item["total"]); ?></td>
												<td><?php echo $item["payment_status"]; ?></td>
												<td><?php echo $item["failed_text"]; ?></td>
												<td><?php echo $item["date"]; ?></td>
												<td><?php echo $item["status"]; ?></td>
												<td>
													<a href="<?php echo site_url("basket/admin/detail/".$item["id"]); ?>" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Detaylar"><i class="fa fa-eye"></i></a>
												</td>
											</tr>
										<?php endif ?>
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
<script>
	$('.price').mask("#,##0.00", {reverse: true});
	
	$('.datepicker').datepicker({
		dateFormat: 'dd/mm/yy',
		monthNames: [ "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ],
		dayNamesMin: [ "Pa", "Pt", "Sl", "Ça", "Pe", "Cu", "Ct" ],
		firstDay:1
	});
	$('#datable_1').DataTable({
		bSort: true,
		aaSorting: [[6, 'desc']]
	});
</script>