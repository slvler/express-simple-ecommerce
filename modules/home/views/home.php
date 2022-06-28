<?php $this->load->view('home/layout/header'); ?>

<?php $this->load->view('slider/home'); ?>

<section class="home">

	<div class="container">

		<div class="row">

			<div class="col-sm-12">

				<?php echo $page['content']; ?>

			</div>

		</div>

	</div>

</section>

<?php $this->load->view('home/layout/footer'); ?>
