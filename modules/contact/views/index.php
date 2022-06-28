<?php $this->load->view('home/layout/header'); ?>

<section class="section-content clearfix">
	<div class="header-top pb-3">
		<div class="container">
			<div class="row">
				<div class="col-6 col-sm-6 col-md-6 pt-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo lang_transform("home"); ?></a></li>
							<li class="breadcrumb-item active"><?php echo $page['title']; ?></li>
						</ol>
					</nav>
					<h1><?php echo $page['title']; ?></h1>
				</div>
				<div class="col-6 col-sm-6 col-md-6 text-right">
					<a href="javascript:history.back();" class="prev d-inline-block margin-top-sm margin-top-xs"><i class="fa fa-chevron-left"></i></a>
				</div>
			</div>
		</div>
	</div>
	<div class="contact py-4 color-000">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<?php if (!empty ($this->session->flashdata('success_message'))): ?>
						<div class="alert alert-success alert-dismissable margin-top-20">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<i class="zmdi zmdi-check pr-15 pull-left"></i><p class="pull-left"><?php echo $this->session->flashdata('success_message'); ?></p> 
							<div class="clearfix"></div>
						</div>
					<?php endif; ?>
					<div class="maps text-center">
						<div class="map p-3 rounded">
							<div id="map-canvas" class="google-map mb-3 "></div>
							<div class="contact-info">
								<div class="row">
									<?php $page['extra'] = json_decode($page['extra']); ?>
									<div class="col-12 col-sm-12 col-md-4 text-center py-3">
										<p><b><?php echo lang_transform("address"); ?></b></p>
										<p>
											<?php echo $page['extra'][1]->value; ?>
										</p>
									</div>
									<div class="col-12 col-sm-6 col-md-4 text-center py-3">
										<p><b><?php echo lang_transform("phone"); ?></b></p>
										<p>
											<a href="tel:<?php echo $page['extra'][2]->value; ?>"><?php echo $page['extra'][2]->value; ?></a>
										</p>
									</div>
									<div class="col-12 col-sm-6 col-md-4 text-center py-3">
										<p><b><?php echo lang_transform("email"); ?></b></p>
										<p>
											<a href="mailto:<?php echo $page['extra'][3]->value; ?>"><?php echo $page['extra'][3]->value; ?></a>
										</p>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="row">
								<div class="col-12">
									<form method="post" accept-charset="utf-8" id="contactForm" class="contact-form">                           
										<div class="row my-3">
											<div class="col-12 col-md-6"> 
												<input type="text" name="fullname" value="" id="fullname" class="form-control validate[required] mb-3" required="required" placeholder="<?php echo lang_transform("form-name-surname"); ?>"  />   
												<input type="email" name="email" value="" id="email" class="form-control validate[required, custom[email]] mb-3" required="required" placeholder="<?php echo lang_transform("form-email"); ?>"  />  
												<input type="text" name="phone" value="" id="phone" class="form-control validate[required, custom[phone]] mb-3" required="required" placeholder="<?php echo lang_transform("form-phone"); ?>"  />
											</div> 
											<div class="col-12 col-md-6">
												<input type="text" name="subject" value="" id="subject" class="form-control validate[required] mb-3" required="required" placeholder="<?php echo lang_transform("form-subject"); ?>"  />

												<textarea name="message" cols="90" rows="4" id="message" class="form-control validate[required] mb-3" required="required" placeholder="<?php echo lang_transform("form-message"); ?>" ></textarea>
											</div>
											<div class="col-12 col-md-6">
												<div class="relative">
													<div class="relative">
														<div class="g-recaptcha" data-sitekey="6LfA_lEUAAAAAE-C4sRfjwUVDfWVhXY69xpF0SnF"></div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<input type="submit" name="" value="<?php echo lang_transform("form-send-btn"); ?>" class="btn btn-block"  /> 
											</div>
										</div>   
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php $this->load->view('home/layout/footer'); ?>
<!--Contact-->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCKAPeAu1waYiWPsGzWPodIBszOP_zCcE&sensor=false"></script>
<script src="assets/js/gm.js"></script>
<script src='assets/plugins/inputMask/jquery.inputmask.bundle.min.js'></script>

<script>
	jQuery(document).ready(function ($) {

		$(".form-control[name='phone']").inputmask({"mask": "(999) 999-9999"});
	});

	initializeMap({
		title        : 'vize4uk',
		coordinate   : '<?php echo $page['extra'][0]->value; ?>',
		zoom     : 16,
		mapWrapperId : 'map-canvas',
		marker     : 'assets/images/iconMarker.png'
	});
</script>