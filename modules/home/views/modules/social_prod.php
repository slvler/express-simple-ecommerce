<div class="social margin-top-5">
	<span class="font-semibold"><?php echo lang_transform("share"); ?>:</span>
	<?php if(settings("social_facebook_url") != NULL): ?>
		<a href="<?php echo settings("social_facebook_url"); ?>" target="_blank" rel="nofollow" class="bg-color-facebook"><i class="fa fa-facebook"></i></a>
	<?php endif; ?>
	<?php if(settings("social_instagram_url") != NULL): ?>
		<a href="<?php echo settings("social_instagram_url"); ?>" target="_blank" rel="nofollow" class="bg-color-instagram"><i class="fa fa-instagram"></i></a>
	<?php endif; ?>
	<?php if(settings("social_linkedin_url") != NULL): ?>
		<a href="<?php echo settings("social_linkedin_url"); ?>" target="_blank" rel="nofollow" class="bg-color-linkedin"><i class="fa fa-linkedin"></i></a>
	<?php endif; ?>
	<?php if(settings("social_youtube_url") != NULL): ?>
		<a href="<?php echo settings("social_youtube_url"); ?>" target="_blank" rel="nofollow" class="bg-color-youtube"><i class="fa fa-youtube-play"></i></a>
	<?php endif; ?>
	<?php if(settings("social_twitter_url") != NULL): ?>
		<a href="<?php echo settings("social_twitter_url"); ?>" target="_blank" rel="nofollow" class="bg-color-twitter"><i class="fa fa-twitter"></i></a>
	<?php endif; ?>
	<?php if(settings("social_googleplus_url") != NULL): ?>
		<a href="<?php echo settings("social_googleplus_url"); ?>" target="_blank" rel="nofollow" class="bg-color-googleplus"><i class="fa fa-google-plus"></i></a>
	<?php endif; ?>
	<?php if(settings("social_pinterest_url") != NULL): ?>
		<a href="<?php echo settings("social_pinterest_url"); ?>" target="_blank" rel="nofollow" class="bg-color-pinterest"><i class="fa fa-pinterest"></i></a>
	<?php endif; ?>
</div>