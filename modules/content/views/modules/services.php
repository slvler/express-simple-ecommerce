<?php
$this->load->helper("content/content");
$record = get_content($id = get_lang_id_record(1,'content',$this->session->userdata('lang'))->id);
$records = get_contents($id = get_lang_id_record(1,'content',$this->session->userdata('lang'))->id);
?>

<div class="services py-5 mt-5">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="title text-center pb-4">
					<h6>VIZE 4 UK</h6>
					<h2><?php echo strtoupper($record['title']); ?></h2>
				</div>
				<div class="details mt-1">
					<p>
						<?php echo $record['summary']; ?>
					</p>
				</div>
				<?php echo $record['content']; ?>
			</div>
		</div>
	</div>

	<!--<div class="container-fluid">
		<div class="services-list pt-5">
			<ul class="list-unstyled slick">
			<?php foreach ($records as $row) { ?>
				<li class="mx-3">
					<div class="item relative">
						<div class="image">
							<img src="<?php echo image_moo($row->list_img, 264, 264); ?>" class="img-fluid rounded" alt="">
						</div>
						<div class="desc">
							<div class="icon rounded-circle">
								<img src="<?php echo image_moo($row->header_img, 57, 57); ?>" class="img-fluid rounded-circle" alt="">
							</div>
							<h4>
								<?php echo $row->title; ?><br/>
								<span></span>
							</h4>
						</div>
					</div>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>-->
	<div class="container-fluid">
		<div class="services-list pt-5">
			<ul class="list-unstyled slick">
				<li class="mx-3">
					<a href="turkish-businessperson-visa">
						<div class="item relative">
							<div class="image">
								<img src="assets/images/services/services_ankara.jpg" class="img-fluid rounded" alt="">
							</div>
							<div class="desc">
								<div class="icon rounded-circle">
									<img src="assets/images/services/icon_ankara.jpg" class="img-fluid rounded-circle" alt="">
								</div>
								<h4>
									ANKARA AGREEMENT<br/>
									<span></span>
								</h4>
							</div>
						</div>
					</a>
				</li>
				<li class="mx-3">
					<a href="tier-1-investor-visa">
						<div class="item relative">
							<div class="image">
								<img src="assets/images/services/services_business.jpg" class="img-fluid rounded" alt="">
							</div>
							<div class="desc">
								<div class="icon rounded-circle">
									<img src="assets/images/services/icon_business.jpg" class="img-fluid rounded-circle" alt="">
								</div>
								<h4>
									BUSINESS<br/>
									<span></span>
								</h4>
							</div>
						</div>
					</a>
				</li>
				<li class="mx-3">
					<a href="2-year-partnership-visa">
						<div class="item relative">
							<div class="image">
								<img src="assets/images/services/services_family.jpg" class="img-fluid rounded" alt="">
							</div>
							<div class="desc">
								<div class="icon rounded-circle">
									<img src="assets/images/services/icon_family.jpg" class="img-fluid rounded-circle" alt="">
								</div>
								<h4>
									FAMILY<br/>
									<span></span>
								</h4>
							</div>
						</div>
					</a>
				</li>
				<li class="mx-3">
					<a href="spouse/partner-visa">
						<div class="item relative">
							<div class="image">
								<img src="assets/images/services/services_family_partner.jpg" class="img-fluid rounded" alt="">
							</div>
							<div class="desc">
								<div class="icon rounded-circle">
									<img src="assets/images/services/icon_family_partner.jpg" class="img-fluid rounded-circle" alt="">
								</div>
								<h4>
									FAMILY PARTNER<br/>
									<span></span>
								</h4>
							</div>
						</div>
					</a>
				</li>
				<li class="mx-3">
					<a href="visitor">
						<div class="item relative">
							<div class="image">
								<img src="assets/images/services/services_indivudal.jpg" class="img-fluid rounded" alt="">
							</div>
							<div class="desc">
								<div class="icon rounded-circle">
									<img src="assets/images/services/icon_INDIVIDUAL.jpg" class="img-fluid rounded-circle" alt="">
								</div>
								<h4>
									INDIVUDUAL<br/>
									<span></span>
								</h4>
							</div>
						</div>
					</a>
				</li>
				<li class="mx-3">
					<a href="sole-representative-visa">
						<div class="item relative">
							<div class="image">
								<img src="assets/images/services/services_SOLE-REPRESENTATIVE.jpg" class="img-fluid rounded" alt="">
							</div>
							<div class="desc">
								<div class="icon rounded-circle">
									<img src="assets/images/services/icon_SOLE-REPRESENTATIVE.jpg" class="img-fluid rounded-circle" alt="">
								</div>
								<h4>
									SOLE REPRESENTATIVE<br/>
									<span></span>
								</h4>
							</div>
						</div>
					</a>
				</li>
				<li class="mx-3">
					<a href="entrepreneur-visa">
						<div class="item relative">
							<div class="image">
								<img src="assets/images/services/services_tier1.jpg" class="img-fluid rounded" alt="">
							</div>
							<div class="desc">
								<div class="icon rounded-circle">
									<img src="assets/images/services/icon_tier1.jpg" class="img-fluid rounded-circle" alt="">
								</div>
								<h4>
									TIER 1<br/>
									<span></span>
								</h4>
							</div>
						</div>
					</a>
				</li>
				<li class="mx-3">
					<a href="tier-4">
						<div class="item relative">
							<div class="image">
								<img src="assets/images/services/services_tier4.jpg" class="img-fluid rounded" alt="">
							</div>
							<div class="desc">
								<div class="icon rounded-circle">
									<img src="assets/images/services/icon_tier4.jpg" class="img-fluid rounded-circle" alt="">
								</div>
								<h4>
									TIER 4<br/>
									<span></span>
								</h4>
							</div>
						</div>
					</a>
				</li>
				<li class="mx-3">
					<a href="visitor">
						<div class="item relative">
							<div class="image">
								<img src="assets/images/services/services_visitor.jpg" class="img-fluid rounded" alt="">
							</div>
							<div class="desc">
								<div class="icon rounded-circle">
									<img src="assets/images/services/icon_visitor.jpg" class="img-fluid rounded-circle" alt="">
								</div>
								<h4>
									VISITOR<br/>
									<span></span>
								</h4>
							</div>
						</div>
					</a>
				</li>
			</ul>
		</div>
	</div>

</div>