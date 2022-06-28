		<div class="section-footer">
		  <div class="container">
			<div class="row">
			  <div class="col-xs-12">
				<ul class="list-inline social">
				  <li><a href="<?php echo settings("social_facebook_url"); ?>" rel="nofollow" target="_blank" class="bg-color-facebook"><i class="fa fa-facebook-f"></i></a></li>
				  <li><a href="<?php echo settings("social_twitter_url"); ?>" rel="nofollow" target="_blank" class="bg-color-twitter"><i class="fa fa-twitter"></i></a></li>
				  <li><a href="<?php echo settings("social_instagram_url"); ?>" rel="nofollow" target="_blank" class="bg-color-instagram"><i class="fa fa-instagram"></i></a></li>
				  <li><a href="<?php echo settings("social_googleplus_url"); ?>" rel="nofollow" target="_blank" class="bg-color-googleplus"><i class="fa fa-google-plus"></i></a></li>
				</ul>
			  </div>
			</div>
		  </div>
		</div>
		<footer class="footer-post pt-3">
		  <div class="container">
			<div class="row">
			  <div class="col-12 col-sm-6 text-center-xs px-0">
				<p><?php echo settings("footer_text"); ?></p>
			  </div>
			  <div class="col-6 col-sm-6 text-right px-0">
				<a href="http://www.egegen.com/" target="_blank" class="egegen">
				  <span class="before"><img src="assets/images/oscar.svg" class="svg"></span>
				  <span class="after"><img src="assets/images/egegen.svg" class="svg egegen-logo" alt="egegen"></span>
				</a>
			  </div>
			</div>
		  </div>
		</footer>

		<!-- back to top -->
		<a class="back-to-top" href="null"><i class="fa fa-angle-up"></i></a>

		<?php if(settings("css_js_cache") == 1): ?>
		<script src="<?php echo minify_assets("js", array(
			"assets/plugins/jquery/jquery.min.js",
			"assets/js/jquery-ui-transitions.min.js",
			"assets/plugins/bootstrap/4.0.0/js/bootstrap.min.js",
			"assets/plugins/bootstrap/4.0.0/js/popper.min.js",
			"assets/plugins/jetmenu/js/jetmenu.min.js",
			"assets/plugins/flexslider/jquery.flexslider.min.js",
			"assets/plugins/fancybox/dist/jquery.fancybox.min.js",
			"assets/plugins/slick/1.8.0/slick.min.js",
			"assets/js/sweetalert.js",
			"assets/js/jquery.browser.selector.js",
			"assets/js/jquery.functions.js",
			"assets/js/jquery.countTo.js",
			"assets/js/main.js"
		)); ?>"></script>
		<?php else: ?>
		<script src="assets/plugins/jquery/jquery.min.js"></script>
		<script src="assets/js/jquery-ui-transitions.min.js"></script>
		<script src="assets/plugins/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="assets/plugins/bootstrap/4.0.0/js/popper.min.js"></script>
		<script src="assets/plugins/jetmenu/js/jetmenu.min.js"></script>
		<script src="assets/plugins/flexslider/jquery.flexslider.min.js"></script>
		<script src="assets/plugins/fancybox/dist/jquery.fancybox.min.js"></script>
		<script src="assets/plugins/slick/1.8.0/slick.min.js"></script>
		<script src="assets/js/sweetalert.js"></script>
		<script src="assets/js/jquery.browser.selector.js"></script>
		<script src="assets/js/jquery.functions.js"></script>
		<script src="assets/js/jquery.countTo.js"></script>
		<script src="assets/js/main.js"></script>
		<?php endif; ?>
		
	</body>
	
	<?php if ((!empty ($this->session->flashdata('success_message'))) || (!empty ($this->session->flashdata('error_message')))): ?>
		<div class="modal" tabindex="-1" role="dialog" id="messagemodal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><?php echo settings("title"); ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php if (!empty ($this->session->flashdata('success_message'))): ?>
						<div class="modal-body alert-success"><?php echo $this->session->flashdata('success_message'); ?></div>
					<?php endif; ?>
					<?php if (!empty ($this->session->flashdata('error_message'))): ?>
						<div class="modal-body alert-danger"><?php echo $this->session->flashdata('error_message'); ?></div>
					<?php endif; ?>
					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Kapat</button>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$('#messagemodal').modal();
		</script>
	<?php endif; ?>
</html>