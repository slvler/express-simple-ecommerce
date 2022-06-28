<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>
<?php $this->load->helper('member/member'); ?>
<?php $this->load->helper('product/product'); ?>
<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h5 class="txt-dark"><?php echo $detail["order_key"]; ?></h5>
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
				<h6 class="mb-15">Sipariş Durumu</h6>
				<form method="POST" class="row">
					<input type="hidden" name="email" value="<?php echo @$detail["email"]; ?>" />
					<input type="hidden" name="order_key" value="<?php echo @$detail["order_key"]; ?>" />
					<input type="hidden" name="name" value="<?php echo @$detail["name"]; ?>" />
					<input type="hidden" name="surname" value="<?php echo @$detail["surname"]; ?>" />
					<div class="col-md-4 col-xs-12">
						<select class="form-control" id="order_status" name="status">
							<option <?php echo($detail["status"] == "Bekliyor" ? "selected" : ""); ?>>Bekliyor</option>
							<option <?php echo($detail["status"] == "Hazırlanıyor" ? "selected" : ""); ?>>Hazırlanıyor</option>
							<option <?php echo($detail["status"] == "Yola Çıktı" ? "selected" : ""); ?>>Yola Çıktı</option>
							<option <?php echo($detail["status"] == "Sipariş Ulaştı" ? "selected" : ""); ?>>Sipariş Ulaştı</option>
							<option <?php echo($detail["status"] == "İptal Edildi" ? "selected" : ""); ?>>İptal Edildi</option>
						</select>
						<input type="text" name="cancellation" id="cancellation" class="form-control" placeholder="Lütfen siparişin iptal sebebini yazınız" <?php echo ($detail["status"]=="İptal Edildi")?'':'style="display: none;"'; ?> <?php echo ($detail["status"]=="İptal Edildi")?'value="'.$detail["status_cancellation"].'"':''; ?>>
					</div>
					<div class="col-md-2 col-xs-12">
						<button type="submit" class="btn btn-block btn-success"><i class="fa fa-check"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xs-12">
		<div class="panel panel-default card-view">	
			<div class="panel-body">
				<h6 class="mb-15">Sipariş Bilgileri</h6>
				<div class="table-wrap">
					<div class="table-responsive">
						<table class="table table-hover mb-0">
							<tbody>
								<tr><td>Sipariş Durumu</td><td><?php echo $detail["status"]; ?></td></tr>
								<?php if($detail["status"] == "Onaylanmamış"): ?>
									<tr><td>Hata</td><td class="text-danger"><?php echo $detail["failed_text"]; ?></td></tr>
								<?php endif; ?>
								<tr><td>Sipariş Numarası</td><td><?php echo $detail["order_key"]; ?></td></tr>
								<tr><td>İndirim Tutarı</td><td><?php echo $detail["discount_price"]; ?> TL</td></tr>
								<tr><td>Ödenen Tutar</td><td><?php echo $detail["total"]; ?> TL</td></tr>
								<tr><td>Tarih</td><td><?php echo $detail["date"]; ?></td></tr>
								<tr><td>Ödeme Durumu</td><td><?php echo $detail["payment_status"]; ?></td></tr>
								<tr><td>Taksit Sayısı</td><td><?php echo $detail["installment"]; ?></td></tr>
								<tr><td>Sipariş Notu</td><td><?php echo $detail["note"]; ?></td></tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xs-12">
		<div class="panel panel-default card-view">	
			<div class="panel-body">
				<h6 class="mb-15">Teslimat Bilgileri</h6>
				<div class="table-wrap">
					<div class="table-responsive">
						<table class="table table-hover mb-0">
							<tbody>
								<?php $address = get_address($detail["member_id"],$detail["address_id"]); ?>
								<tr><td>Ad Soyad</td><td><?php echo @$address["name"]." ".@$address["surname"]; ?></td></tr>
								<tr><td>Telefon</td><td><?php echo @$address["phone"]; ?></td></tr>
								<tr><td>Şehir</td><td><?php echo get_city_title(@$address["city"]); ?></td></tr>
								<tr><td>İlçe</td><td><?php echo get_town_title(@$address["town"]); ?></td></tr>
								<tr><td>Adres</td><td><?php echo @$address["address"]; ?></td></tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="panel panel-default card-view">	
			<div class="panel-body">
				<h6 class="mb-15">Ürün Bilgileri</h6>
				<div class="table-wrap">
					<div class="table-responsive">
						<table class="table table-hover mb-0">
							<thead>
								<tr>
									<th>Ürün Kodu</th>
									<th>Ürün</th>
									<th>Adet</th>
									<th>Birim Fiyatı</th>
									<th>Toplam</th>
								</tr>
							</thead>
							<tbody>
								<?php $order_total = 0; foreach(json_decode($detail["products"], true) as $product): ?>
								<?php
								if (@$product["price_type"]=="KG") {
									$type = "KG";
								}else{
									$type = "ADET";
								}
								?>
								<tr>
									<td><?php echo @get_product(@$product['id'])["prod_code"]; ?></td>
									<td><a href="<?php echo get_seo_url("product/index/".$product['id']); ?>" target="_blank"><?php echo $product["name"]; ?></a></td>
									<td><?php echo $product["qty"]." ".$type; ?></td>
									<td><?php echo $product["price"]; ?> TL</td>
									<td><?php echo $this->cart->format_number(str_replace(",", "", $product["price"]) * $product["qty"],2); ?> TL</td>
								</tr>
								<?php $order_total += $product["subtotal"]; endforeach; ?>
							</tbody>
						</table>
						<div class="order-price col-xs-12 text-center">
							<div class="col-md-3">
								<p>Ara Toplam</p>
								<p><?php echo number_format($order_total,2); ?> TL</p>
							</div>
							<div class="col-md-3">
								<p>İndirim Tutarı</p>
								<p><?php echo $detail["discount_price"]; ?> TL</p>
							</div>
							<div class="col-md-3">
								<p>Toplam Tutar</p>
								<p><?php echo $detail["total"]; ?> TL</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('admin/layout/footer'); ?>
<?php $this->load->view('admin/layout/end'); ?>
<script type="text/javascript">
	$('#order_status').change(function(){
		if ($(this).val()=="İptal Edildi") {
			$('#cancellation').css("display","block");
			$("#cancellation").prop('required',true);
		}else{
			$('#cancellation').css("display","none");
		}
	});
</script>
