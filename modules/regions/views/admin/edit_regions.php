<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>
<?php $this->load->helper('member/member'); ?>
<link href="assets/admin/dist/css/chosen.css" rel="stylesheet" type="text/css">
<div class="row heading-bg">
	<div class="col-xs-12">
		<h5 class="txt-dark">Hizmet Verilen Bölgeler</h5>
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
						<?php if(@$_GET["city"] && !@$_GET["town"]): ?>
							<form method="get" enctype="multipart/form-data">
								<input type="hidden" name="city" value="<?php echo @$this->input->get("city"); ?>">
								<input type="hidden" name="regions_id" value="<?php echo @$this->input->get("regions_id"); ?>">
								<div  class="pills-struct">
									<div class="tab-content">
										<div id="lang" class="tab-pane fade active in" role="tabpanel">
											<div class="row">
												<div id="input_fields_wrap">
													<div class="col-xs-12">
														<div class="form-group">
															<label class="control-label mb-10 text-left" for="town">İlçe</label>
															<select class="form-control chosen-select" multiple name="town[]" id="town" required="required">
																<?php foreach ($town as $row): ?>
																	<option value="<?php echo $row->key ?>"><?php echo $row->title; ?></option>
																<?php endforeach ?>
															</select>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group clearfix">
									<button type="submit" class="btn btn-success pull-right">Devam et</button>
								</div>
							</form>
						<?php elseif(@$_GET["city"] && @$_GET["town"]): ?>
							<form method="post" enctype="multipart/form-data">
								<input type="hidden" name="city" value="<?php echo @$this->input->get("city"); ?>">
								<input type="hidden" name="regions_id" value="<?php echo @$this->input->get("regions_id"); ?>">
								<?php foreach ($this->input->get("town") as $keys => $value): ?>
									<input type="hidden" name="town[]" value="<?php echo $value; ?>">
								<?php endforeach ?>
								<div  class="pills-struct">
									<div class="tab-content">
										<div id="lang" class="tab-pane fade active in" role="tabpanel">
											<div class="row">
												<div id="input_fields_wrap">
													<div class="col-xs-12">
														<?php foreach ($district as $key => $item): ?>
															<div class="form-group">
																<label class="control-label mb-10 text-left" for="district"><?php echo get_town_title($key); ?></label>
																<select class="form-control chosen-select district_<?php echo $key; ?>" multiple name="district[<?php echo $key; ?>][]" id="district">
																	<?php foreach ($item as $item2): ?>
																		<option value="<?php echo $item2->key ?>"><?php echo $item2->title; ?></option>
																	<?php endforeach ?>
																</select>
															</div>
														<?php endforeach ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group clearfix">
									<button type="submit" class="btn btn-success pull-right">Kaydet</button>
								</div>
							</form>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('admin/layout/footer'); ?>
<?php $this->load->view('admin/layout/end'); ?>
<script src="assets/admin/dist/js/chosen.js"></script>
<?php if (@$_GET["city"] && !@$_GET["town"]): ?>
	<script>
		activateChosen($('body'));
		selectChosenOptions($('.chosen-select'), [<?php echo $town_result; ?>]);

		function activateChosen($container, param) {
			param = param || {};
			$container.find('.chosen-select:visible').chosen(param);
			$container.find('.chosen-select').trigger("chosen:updated");
		}

		function selectChosenOptions($select, values) {
			$select.val(null);
			$select.val(values);
			$select.trigger('chosen:updated');
		}
		$(".chosen-select").chosen();
	</script>
<?php elseif(@$_GET["city"] && @$_GET["town"]): ?>
	<?php foreach ($district_result as $i => $item3): ?>
		<script>
			activateChosen($('body'));
			selectChosenOptions($('.chosen-select.district_<?php echo $i; ?>'), [<?php echo $item3; ?>]);

			function activateChosen($container, param) {
				param = param || {};
				$container.find('.chosen-select:visible').chosen(param);
				$container.find('.chosen-select').trigger("chosen:updated");
			}

			function selectChosenOptions($select, values) {
				$select.val(null);
				$select.val(values);
				$select.trigger('chosen:updated');
			}
			$(".chosen-select").chosen();
		</script>
	<?php endforeach ?>
<?php endif ?>