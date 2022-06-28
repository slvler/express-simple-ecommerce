<?php $this->load->view('home/layout/meta'); ?>
<header>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-6 text-center-sm">
				<a href="<?php echo base_url(); ?>" class="logo"><img src="<?php echo site_url(settings("logo")); ?>" alt="<?php echo settings("title"); ?>" class="img-fluid" data-rjs="3" /></a>
			</div>
			<div class="col-sm-6 col-md-3 pt-2">
				<form action="<?php echo base_url("search"); ?>" method="get">
					<input type="text" name="search" placeholder="Arama yapınız..">
					<button>Ara</button>
				</form>
			</div>
			<div class="col-sm-6 col-md-2 text-right pt-2">
				<?php if ($this->session->userdata("member_login") == NULL) { ?>
				<a href="<?php echo base_url("member/signin"); ?>"><?php echo lang_transform("signin"); ?></a> |
				<a href="<?php echo base_url("member/signup"); ?>"><?php echo lang_transform("signup"); ?></a>
				<?php }else{ ?>
				<a href="<?php echo base_url("Member/Member/profile"); ?>"><?php echo lang_transform("my_profile"); ?></a> |
				<a href="<?php echo base_url("Member/Member/logout"); ?>"><?php echo lang_transform("sign_out"); ?></a>
				<?php } ?>
			</div>
			<div class="col-sm-6 col-md-1 text-right pt-2">
				<select id="navigation">
					<?php foreach (all_languages() as $row) { ?>
					<option value="<?php echo base_url("language?lang=".$row->lang); ?>" <?php echo ($this->session->userdata('lang') == $row->lang)? "selected" : ""; ?>><?php echo strtoupper($row->lang); ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
</header>
<section class="menu">
	<div class="container">
		<div class="row">
			<?php $this->load->view('menu/main'); ?>
		</div>
	</div>
</section>
