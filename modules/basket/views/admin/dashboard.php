<?php 
$this->load->helper("basket/basket");
$order = dashboard_order(50);
?>
<div class="panel panel-default card-view">
	<div class="panel-heading">
		<h6 class="panel-title txt-dark">Siparişler</h6>
	</div>
	<div class="panel-wrapper collapse in">
		<div class="panel-body">
			<table class="table mb-0">
				<thead>
					<tr>
						<th>Sipariş Numarası</th>
						<th>Ad Soyad</th>
						<th>Tutar</th>
						<th>Tarih</th>
						<th>Durum</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($order as $item): ?>										
						<?php if ($item["status"]=="Bekliyor" || $item["status"]=="Hazırlanıyor" || $item["status"]=="Kargoya Verildi"): ?>
							<tr class="<?php 
							if($item["status"]=="Bekliyor"){ echo "order-info"; }
							elseif($item["status"]=="Hazırlanıyor"){ echo "order-warning"; }
							elseif($item["status"]=="Kargoya Verildi"){ echo "order-success"; }
							?>">
							<td><?php echo $item["order_key"]; ?></td>
							<td><?php echo $item["name"]." ".$item["surname"]; ?></td>
							<td><?php echo $this->cart->format_number($item["total"]); ?></td>
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