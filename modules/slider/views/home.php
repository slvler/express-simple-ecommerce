<?php
$this->load->helper("slider/slider");
$slider_data = slider();
?>
<?php if (!empty ($slider_data)): ?>
	<section class="slider">
		<div class="container-fluid p-0">
			<div class="flexslider box-no-border box-no-border-radius box-no-shadow">
				<ul class="slides">
					<?php foreach ($slider_data as $row) { ?>
					<li class="item" style="background-image:url('<?php echo image_moo($row->media, 1920, 400); ?>')">
						<div class="container relative">
							<div class="flex-caption">
								<div class="font-size-30 font-bold mb-2"><?php echo $row->title; ?></div>
								<?php echo $row->description; ?>
							</div>
						</div>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</section>
<?php endif; ?>