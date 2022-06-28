<?php $this->load->view('home/layout/header'); ?>

<section class="section-content clearfix">

	<div class="header-top">
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

	<div class="main pt-2 pb-2 bg-white">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<?php if ($page['header_img'] != NULL) { ?>
					<img src="<?php echo $page['header_img']; ?>" class="img-fluid">
					<?php } ?>
					<div class="details text-center">
						<?php if ($page['video'] != NULL) { ?>
						<div class="video p-3 bg-white rounded">
							<?php $page['video'] = str_replace("watch?v=", "embed/", $page['video']); ?>
							<iframe src="<?php echo $page['video']; ?>" width="560" height="314" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media" allowFullScreen="true"></iframe>
						</div>
						<?php } ?>
						<h1 class="mb-0 mt-3 font-size-22 text-left"><?php echo $page['title']; ?></h1>
						<div class="desc text-left py-4">
							<?php if ($page['content'] != NULL) { ?>
							<?php echo $page['content']; ?>
							<?php } ?>
						</div>
						<?php /* FOTO GALERİ */ ?>
						<?php if (isset($page['gallery_images'])): ?>
							<div class="clearfix"></div>
							<div class="content-grid mb-5">
								<div class="row">
									<?php foreach ($page['gallery_images'] as $item): ?>

										<a data-fancybox="gallery" rel="group" href="<?php echo $item->url; ?>" class="fancybox col-md-3 text-center mb-4">
											<img src="<?php echo image_moo($item->url, 320, 450); ?>" class="img-fluid thumbnail m-0" />
										</a>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>

			</div>
		</div>
	</div>

</section>

<?php $this->load->view('home/layout/footer'); ?>