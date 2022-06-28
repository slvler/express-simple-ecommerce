<?php
$this->load->helper("content/content");
$record = get_content($id = get_lang_id_record(8,'content',$this->session->userdata('lang'))->id);
?>

<div class="why py-3 my-3">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6">
				<div class="image">
					<img src="<?php echo image_moo($record['list_img']); ?>" class="img-fluid" alt="">
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="details">
					<div class="title pb-4">
						<h6 class="mb-0 mt-4"><?php echo $record['summary']; ?></h6>
						<h2><?php echo $record['title']; ?></h2>
					</div>
					<?php echo $record['content']; ?>
				</div>
			</div>
		</div>
	</div>
</div>