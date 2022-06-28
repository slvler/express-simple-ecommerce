<div class="about text-center">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="details">
					<?php $home_summary = explode("|",  $page['summary']); ?>
					<div class="title">
						<h6 class="mb-1"><?php echo $home_summary[0]; ?></h6>
						<h2 class="mt-0 mb-3">
							<?php echo $home_summary[1]; ?>
						</h2>
					</div>
					<div class="desc">
						<div class="title-desc">
							<h5> <span><?php echo $home_summary[2]; ?></span></h5>
						</div>
						<?php echo $page['content']; ?>
						<?php $id = get_lang_id_record(16,'content',$this->session->userdata('lang'))->id ?>
						<a href="<?php echo get_seo_url("content/index/".$id); ?>" class="read-more">
							ABOUT US
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>