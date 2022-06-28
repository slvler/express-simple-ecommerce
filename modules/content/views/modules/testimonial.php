<?php
$this->load->helper("content/content");
$record = get_content($id = get_lang_id_record(9,'content',$this->session->userdata('lang'))->id);
$records = get_contents($id = get_lang_id_record(9,'content',$this->session->userdata('lang'))->id);
?>

<div class="testimonial py-5 color-fff">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="title pb-3">
					<h3 class="font-size-26">
						<?php echo $record['title']; ?>
					</h3>
				</div>
				<div class="items slick">
					<?php foreach ($records as $row) { ?>
					<div class="item">
						<p class="font-italic">
							<?php echo $row->summary; ?>
						</p>
						<p>
							<?php echo $row->title; ?>,
						</p>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>