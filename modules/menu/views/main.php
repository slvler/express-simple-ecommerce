<?php
$this->load->helper("menu/menu");
$menu_data = menu(1);
?>

<ul id="jetmenu" class="jetmenu">
	<?php $i=0; foreach ($menu_data as $item): ?>
	<?php $link = site_url($item->url); ?>
	<?php if($item->target != "_self"){$link = $item->url;} ?>
	<?php if($item->child): ?>
		<li>
			<a href="<?php echo $link; ?>" data-toggle="dropdown"><?php echo $item->title; ?></a>
			<ul class="dropdown">
				<?php foreach($item->child as $itemchild): ?>
					<?php $chlink = site_url($itemchild->url); ?>
					<?php if($itemchild->target != "_self"){$chlink = $itemchild->url;} ?>
					<li>
						<?php if ($itemchild->child) { ?>
						<a href="<?php echo $chlink; ?>" target="<?php echo $itemchild->target; ?>" data-toggle="dropdown"><?php echo $itemchild->title; ?></a>
						<?php }else{ ?>
						<a href="<?php echo $chlink; ?>" target="<?php echo $itemchild->target; ?>"><?php echo $itemchild->title; ?></a>
						<?php } ?>
						<?php if ($itemchild->child) { ?>
						<ul class="dropdown">
							<?php foreach($itemchild->child as $itemchild2): ?>
								<?php $chlink = site_url($itemchild2->url); ?>
								<?php if($itemchild2->target != "_self"){$chlink = $itemchild2->url;} ?>
								<li>
									<a href="<?php echo $chlink; ?>" target="<?php echo $itemchild2->target; ?>"><?php echo $itemchild2->title; ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
						<?php } ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</li>
	<?php else: ?>
		<li class="<?php echo($item->url == $this->uri->uri_string)?"active":""; ?>">
			<a href="<?php echo $link; ?>" target="<?php echo $item->target; ?>">
				<?php echo $item->title; ?>
			</a>
		</li>
	<?php endif; ?>
	<?php $i++; endforeach; ?>
</ul>

