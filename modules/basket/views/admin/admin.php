<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>
<?php $this->load->helper('member/member'); ?>
<?php $this->load->helper('regions/regions'); ?>
<?php $this->load->helper('payment_method/payment_method'); ?>
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
					<form class="row" method="GET" autocomplete="off">
						<div class="col-md-2 col-xs-12">
							<select name="regions" class="form-control">
								<option value="">Tüm Şubeler</option>
								<?php foreach (get_all_regions() as $row): ?>
									<option value="<?php echo $row->id; ?>" <?php echo (@$_GET["regions"]==$row->id)?'selected':''; ?>><?php echo $row->title; ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="col-md-4 col-xs-12">
							<div class="row">
								<div class="col-xs-6 pl-0">
									<input type="text" class="form-control price" name="order_key" placeholder="Sipariş Numarası" value="<?php echo @$_GET["order_key"] ?>" />
								</div>
								<div class="col-xs-6 pl-0">
									<input type="text" class="form-control" name="email" placeholder="E-posta adresi" value="<?php echo @$_GET["email"] ?>" />
								</div>
							</div>
						</div>
						<div class="col-md-2 col-xs-12">
							<select name="status" class="form-control">
								<option value="">Tüm Durumlar</option>
								<option <?php echo(@$_GET["status"]=="Bekliyor")?"selected":""; ?>>Bekliyor</option>
								<option <?php echo(@$_GET["status"]=="Hazırlanıyor")?"selected":""; ?>>Hazırlanıyor</option>
								<option <?php echo(@$_GET["status"]=="Yola Çıktı")?"selected":""; ?>>Yola Çıktı</option>
								<option <?php echo(@$_GET["status"]=="Sipariş Ulaştı")?"selected":""; ?>>Sipariş Ulaştı</option>
								<option <?php echo(@$_GET["status"]=="İptal Edildi")?"selected":""; ?>>İptal Edildi</option>
							</select>
						</div>
						<div class="col-md-2 col-xs-12">
							<select name="payment" class="form-control">
								<option value="">Tüm Ödeme Türleri</option>
								<option <?php echo(@$_GET["payment"]=="Online Kredi Kartı Ödeme")?"selected":""; ?>>Online Kredi Kartı Ödeme</option>
								<?php foreach (get_payment_methods() as $key => $value): ?>
									<option <?php echo(@$_GET["payment"]==$value->title)?"selected":""; ?>><?php echo $value->title; ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="col-md-2 col-xs-12">
							<button type="submit" class="btn btn-block btn-success">Göster</button>
						</div>
						<!-- <div class="col-md-1 col-xs-6">
							<?php 
							if($this->input->server('QUERY_STRING')){
								$export_uri = "basket/admin/generate_excel?status_type=".$status_type."&".$this->input->server('QUERY_STRING'); 
							} else {
								$export_uri = "basket/admin/generate_excel?status_type=".$status_type;
							}
							?>
							<a href="<?=site_url($export_uri)?>" class="btn btn-block btn-primary" data-toggle="tooltip" title="Dışa Aktar"><i class="fa fa-file-excel-o"></i></a>
						</div> -->
					</form>
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
							<table class="table mb-0 table-hover display dataTable" id="datable_1">
								<thead>
									<tr>
										<th>Sipariş Numarası</th>
										<th>Ad Soyad</th>
										<th>E-posta</th>
										<th>Tutar</th>
										<th>Şube</th>
										<th>Ödeme</th>
										<th>Tarih</th>
										<th>Durum</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($order as $item): ?>
										<?php $member = get_member($item["member_id"]); ?>
										<tr class="<?php 
										if($item["status"]=="Bekliyor"){ echo ""; }
										elseif($item["status"]=="Hazırlanıyor"){ echo "bg-waiting"; }
										elseif($item["status"]=="İptal Edildi"){ echo "bg-danger"; }
										elseif($item["status"]=="Yola Çıktı"){ echo "bg-info"; }
										elseif($item["status"]=="Sipariş Ulaştı"){ echo "bg-success"; }
										?>">
										<td><?php echo $item["order_key"]; ?></td>
										<td><?php echo $member["name"]." ".$member["surname"]; ?></td>
										<td><?php echo $member["email"]; ?></td>
										<td><?php echo $item["total"]; ?></td>
										<td><?php echo get_region_data($item["region_id"])->title; ?></td>
										<td><?php echo $item["payment_status"]; ?></td>
										<td><?php echo $item["date"]; ?></td>
										<td><?php echo $item["status"]; ?></td>
										<td>
											<a href="<?php echo site_url("basket/admin/detail/".$item["id"]); ?>" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Detaylar"><i class="fa fa-eye"></i></a>
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
		aaSorting: [[5, 'desc']]
	});
</script>
