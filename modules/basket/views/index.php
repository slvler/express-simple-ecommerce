<?php $this->load->view('home/layout/header'); ?>
<?php $this->load->view('search/search'); ?>
<?php
$this->load->helper('campaign/campaign');
$campaign = campaigns(1);
$campaign_options = json_decode(campaigns(1)["options"]);
?>
<main id="main" class="main container">
	<h1 class="page-title subtitle"><?php echo $page["title"]; ?></h1>
	<div class="row pt-2">
		<div class="col-12 col-lg-8">
			<div class="basket">
				<div class="basket-head">
					<div class="basket-col item-image"></div>
					<div class="basket-col item-name">Ürün</div>
					<div class="basket-col item-quantity">Adet</div>
					<div class="basket-col item-price">Toplam</div>
					<div class="basket-col item-action"></div> 
				</div>
				<div class="basket-list">
					<?php foreach ($this->cart->contents() as $row): ?>
						<?php
						if ($row["list_img"]) {
							$img = $row["list_img"];
						}elseif (file_exists('upload/product_images/'.$row["prod_code"].'.jpg')) {
							$img = 'upload/product_images/'.$row["prod_code"].'.jpg';
						}else{
							$img = 'assets/img/ozsut.jpg';
						}
						$price = str_replace(",", "", $row["price"]) * $row["qty"];
						if (@$row["price_type"]=="KG") {
							$type = "KG";
						}else{
							$type = "ADET";
						}
						?>
						<div class="basket-item">
							<div class="basket-col item-image">
								<img src="<?php echo image_moo($img); ?>" alt="<?php echo $row["title"]; ?>">
							</div>
							<div class="basket-col item-name">
								<h5 class="basket-item__title"><?php echo $row["title"]; ?></h5>
								<span class="basket-item__amount"><?php echo $row["price"]; ?> ₺</span>
							</div>
							<div class="basket-col item-quantity">
								<div class="qty-wrapper">
									<div class="qty-btns">
										<button class="btn qty-btn qty-btn-minus" name="value" value="0" onclick="Cart.qtyUpdate('<?php echo $row["prod_code"]; ?>',this)">
											<svg class="icon">
												<use xlink:href="#icon-minus"></use>
											</svg>
										</button>
										<input type="hidden" name="prod_code" value="<?php echo $row["prod_code"]; ?>">
										<input type="number" name="quantity" data-increment="1" data-min="1" value="<?php echo $row["qty"]; ?>" class="qty qty-input" data-value="1" pattern="[1-9]*" min="1" maxlength="99" onkeypress="return EGEGEN.isNumber(event)" aria-invalid="false">
										<button class="btn qty-btn qty-btn-plus" name="value" value="1" onclick="Cart.qtyUpdate('<?php echo $row["prod_code"]; ?>',this)">
											<svg class="icon">
												<use xlink:href="#icon-plus"></use>
											</svg>
										</button>
									</div>
									<div class="qty-label"><?php echo $type; ?></div>
								</div>
							</div>
							<div class="basket-col item-price">
								<div class="basket-item__price">
									<span class="price-amount"><?php echo number_format($price,2); ?></span>
									<span class="price-currency">₺</span>
								</div>
							</div>
							<div class="basket-col item-action">
								<!-- <button type="button" class="btn btn-sm btn-remove" onclick="Cart.remove('<?php echo $row["prod_code"]; ?>')" title="Sil">
									<span class="btn-remove_icon">
										<svg class="icon icon-sm">
											<use xlink:href="#icon-close"></use>
										</svg>
									</span>
								</button> -->
								<a href="<?php echo site_url("basket/delete/".$row["prod_code"]); ?>" class="btn btn-sm btn-remove" title="Sil">
									<span class="btn-remove_icon">
										<svg class="icon icon-sm">
											<use xlink:href="#icon-close"></use>
										</svg>
									</span>
								</a>
							</div> 
						</div>
					<?php endforeach ?>
				</div>
			</div>
			<form method="post" action="<?php echo site_url("odeme-bilgileri"); ?>" id="basket_note_form">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title"><i class="icon-note text-primary"></i> Sipariş Notunuz</h4>
						<p class="card-header__text">Siparişleriniz ile ilgili toplu bir not yazabilirsiniz…</p>
					</div>
					<div class="card-body">
						<textarea name="basket_note" rows="3" class="input textarea no-radius"></textarea>
					</div>
				</div>
			</form>
		</div>
		<div class="col-12 col-lg-4">
			<div class="sticky">
				<div class="card card-summary-product">
					<div class="card-header">
						<h4 class="card-title  color-primary">
							<svg class="icon icon-md mr-2">
								<use xlink:href="#icon-cart"></use>
							</svg>
							Sepet Özetiniz
						</h4>
					</div>
					<div class="card-body py-1">
						<ul class="summary-product">
							<?php foreach ($this->cart->contents() as $row): ?>
								<?php
								if ($row["list_img"]) {
									$img = $row["list_img"];
								}elseif (file_exists('upload/product_images/'.$row["prod_code"].'.jpg')) {
									$img = 'upload/product_images/'.$row["prod_code"].'.jpg';
								}else{
									$img = 'assets/img/ozsut.jpg';
								}
								$price = str_replace(",", "", $row["price"]) * $row["qty"];
								?>
								<li>
									<div class="media">
										<div class="media-left">
											<img src="<?php echo image_moo($img); ?>" class="summary-product__image" alt="<?php echo $row["title"]; ?>">
										</div>
										<div class="media-body">
											<h6 class="summary-product__title">
												<?php echo $row["title"]; ?>
											</h6>
											<p class="summary-product__info"><span><?php echo $row["qty"]; ?></span> x <span><?php echo $row["price"]; ?> TL</span>  </p>
										</div>
										<div class="summary-product__price"><?php echo number_format($price,2); ?> TL</div>
									</div>
								</li>
							<?php endforeach ?>
						</ul>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<ul class="order-summary">
							<?php $total_price = $this->cart->total(); ?>
							<li>
								<span class="order-summary__label">Sepet Toplamı:</span>
								<span class="order-summary__price"><?php echo number_format($this->cart->total(),2); ?> TL</span>
							</li>
							<?php if ($campaign["active"]==1 && number_format($this->cart->total(),2) >= $campaign_options->order_price): ?>
								<?php
								$result = number_format($total_price,2) / $campaign_options->order_price;
								$discount_price = $campaign_options->discount_price * (int)$result;
								?>
								<li>
									<span class="order-summary__label">İndirim Tutarınız:</span>
									<span class="order-summary__price"><?php echo number_format($discount_price,2); ?> TL</span>
								</li>
								<?php $total_price = $total_price - $discount_price; ?>
							<?php endif ?>
							<li class="order-summary__total">
								<span class="order-summary__label">Toplam Tutar:</span>
								<span class="order-summary__price"><?php echo number_format($total_price,2); ?> TL</span>
							</li>
						</ul>
					</div>
				</div>
				<button type="submit" class="btn btn-primary btn-block btn-basket-order">Siparişi Tamamla</button>
			</div>
		</div>
	</div>
</main>
<?php $this->load->view('home/layout/footer'); ?>
<link rel="stylesheet" href="assets/css/basket.css" />
<script type="text/javascript">
	$('.btn-basket-order').click(function(){
		document.getElementById("basket_note_form").submit();
	});
</script>