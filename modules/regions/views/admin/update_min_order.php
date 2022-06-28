<?php $this->load->view('admin/layout/header'); ?>

<?php $this->load->view('admin/layout/top'); ?>

<?php $this->load->view('admin/layout/leftside'); ?>

<?php $this->load->helper('member/member'); ?>

<div class="row heading-bg">

	<div class="col-xs-12">

		<h5 class="txt-dark">Şube Bölgelerinin Minimum Sipariş Tutarları</h5>

	</div>

</div>

<?php if (!empty ($this->session->flashdata('success_message'))): ?>

	<div class="alert alert-success alert-dismissable">

		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

		<i class="zmdi zmdi-check pr-15 pull-left"></i><p class="pull-left"><?php echo $this->session->flashdata('success_message'); ?></p> 

		<div class="clearfix"></div>

	</div>

<?php endif; ?>

<?php if (!empty ($this->session->flashdata('error_message'))): ?>

	<div class="alert alert-danger alert-dismissable">

		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

		<i class="zmdi zmdi-check pr-15 pull-left"></i><p class="pull-left"><?php echo $this->session->flashdata('error_message'); ?></p> 

		<div class="clearfix"></div>

	</div>

<?php endif; ?>

<div class="row">

	<div class="col-sm-12">

		<div class="panel panel-default card-view">

			<div class="panel-wrapper collapse in">			

				<div class="panel-body">

					<div class="form-wrap">

						<form method="post" enctype="multipart/form-data">

							<div  class="pills-struct">

								<div class="tab-content">

									<div id="lang" class="tab-pane fade active in" role="tabpanel">

										<div class="row">

											<?php foreach (json_decode($page["district"]) as $key => $item): ?>

												<?php $district_order = 0; ?>

												<?php foreach ($item as $row): ?>

													<?php

													if (@$page["district_min_order"]) {

														foreach (json_decode($page["district_min_order"]) as $keys => $value) {

															if ($keys==$row) {

																$district_order = $value;

															}

														}

													}

													?>

													<div class="col-xs-6 col-md-2">

														<div class="form-group" style="min-height: 100px;">

															<label class="control-label mb-10 text-left"><?php echo get_district_title($row)." (".get_town_title($key).")"; ?></label>

															<input type="text" class="form-control" name="district_min_order[<?php echo $row; ?>]" value="<?php echo $district_order; ?>" />

														</div>

													</div>

												<?php endforeach ?>

											<?php endforeach ?>

										</div>

									</div>

								</div>

							</div>

							<div class="form-group clearfix">

								<button type="submit" class="btn btn-success pull-right">Devam et</button>

							</div>

						</form>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>



<?php $this->load->view('admin/layout/footer'); ?>

<?php $this->load->view('admin/layout/end'); ?>