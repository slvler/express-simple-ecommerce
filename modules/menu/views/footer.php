<?php
$this->load->helper("menu/menu");
$menu_data = menu(19);
?>

<div class="itemTitle mb-1">Menu</div>
<ul class="list-unstyled m-0">
	<?php foreach ($menu_data as $item): ?>
		<?php $link = site_url($item->url); ?>
		<?php if($item->target != "_self"){$link = $item->url;} ?>
		<li class="w-50 float-left">
			<a href="<?php echo $link; ?>" target="<?php echo $item->target; ?>">
				<i class="icofont icofont-simple-right"></i><?php echo $item->title; ?>
			</a>
		</li>
	<?php endforeach; ?>
</ul>