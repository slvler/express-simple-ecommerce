<?php $this->load->helper("workshop/workshop"); ?>
<div class="header-cart dropdown hidden-lg-down">
	<button type="button" class="btn-unstyled dropdown-toggle btn-cart" data-toggle="dropdown">
		<i class="fa fa-shopping-cart"></i>
		<span class="badge badge-danger"><?php echo count($this->cart->contents()); ?></span>
	</button>
	<div class="dropdown-menu dropdown-menu-right dropdown-cart">
		<?php if(count($this->cart->contents()) > 0): ?>
			<div class="content-item">
				<table class="table table-striped mb-0">
					<tbody>
						<?php foreach ($this->cart->contents() as $items): ?>
							<tr class="cart-item">
								<td class="text-left size-img-cart">
									<a href="<?php echo get_seo_url($items['type']."/index/".$items['id']); ?>">
									<?php if ($items['type']=="product"): ?>
											<img src="<?php echo image_moo(get_product($items["id"])["list_img"],60,72,"#fff"); ?>" class="img-thumbnail" alt="<?php echo $items['name']; ?>" />
										<?php else: ?>
											<img src="<?php echo image_moo(get_workshop($items["id"])["list_img"],60,72,"#fff"); ?>" class="img-thumbnail" alt="<?php echo $items['name']; ?>" />
										<?php endif ?>
									</a>
								</td>
								<td class="text-left">
									<a href="<?php echo get_seo_url($items['type']."/index/".$items['id']); ?>" class="cart-item-title"><?php echo $items['name']; ?></a>
								</td>
								<td class="text-right">x <?php echo $items['qty']; ?></td>
								<td class="text-right"><?php echo $this->cart->format_number($items['price']); ?> TL</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="flexbox dropdown-footer">
				<a href="<?php echo site_url("basket"); ?>" class="btn btn-gray btn-view-cart">Sepete Git</a>
				<a href="<?php echo site_url("basket/order"); ?>" class="btn btn-success btn-checkout">Satın Al</a>
			</div>
		<?php else: ?>
			<div class="alert alert-danger mb-0" role="alert">Sepetiniz şu anda boş.</div>
		<?php endif; ?>
	</div>
</div>
<div class="header-cart dropdown d-lg-none">
	<button type="button" class="btn-unstyled dropdown-toggle btn-cart" data-toggle="dropdown">
		<i class="fa fa-shopping-cart"></i>
		<span class="badge badge-danger"><?php echo count($this->cart->contents()); ?></span>
	</button>
	<div class="dropdown-menu dropdown-menu-right dropdown-cart">
		<?php if(count($this->cart->contents()) > 0): ?>
			<div class="content-item">
				<table class="table table-striped mb-0">
					<tbody>
						<?php foreach ($this->cart->contents() as $items): ?>
							<tr class="cart-item">
								<td class="text-left size-img-cart">
									<a href="<?php echo get_seo_url($items['type']."/index/".$items['id']); ?>">
									<?php if ($items['type']=="product"): ?>
											<img src="<?php echo image_moo(get_product($items["id"])["list_img"],60,72,"#fff"); ?>" class="img-thumbnail" alt="<?php echo $items['name']; ?>" />
										<?php else: ?>
											<img src="<?php echo image_moo(get_workshop($items["id"])["list_img"],60,72,"#fff"); ?>" class="img-thumbnail" alt="<?php echo $items['name']; ?>" />
										<?php endif ?>
									</a>
								</td>
								<td class="text-left">
									<a href="<?php echo get_seo_url($items['type']."/index/".$items['id']); ?>" class="cart-item-title"><?php echo $items['name']; ?></a>
								</td>
								<td class="text-right">x <?php echo $items['qty']; ?></td>
								<td class="text-right"><?php echo $this->cart->format_number($items['price']); ?> TL</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="flexbox dropdown-footer">
				<a href="<?php echo site_url("basket"); ?>" class="btn btn-gray btn-view-cart">Sepete Git</a>
				<a href="<?php echo site_url("basket/order"); ?>" class="btn btn-success btn-checkout">Satın Al</a>
			</div>
		<?php else: ?>
			<div class="alert alert-danger mb-0" role="alert">Sepetiniz şu anda boş.</div>
		<?php endif; ?>
	</div>
</div>