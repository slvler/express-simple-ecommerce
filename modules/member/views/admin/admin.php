<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

	<div class="row heading-bg">
		<div class="col-md-3 col-xs-6">
			<h5 class="txt-dark">Üyeler</h5>
		</div>
		<div class="col-md-6 col-xs-6">
			<form action="<?php echo site_url("member/admin"); ?>" method="get">
				<div class="row">
					<div class="col-md-10 col-xs-6 pa-0">
						<input type="text" placeholder="Üyelerde Ara (<?php echo $total_count; ?>)" class="form-control" name="s" value="<?php echo @$_GET["s"] ?>" autocomplete="off" />					
					</div>
					<div class="col-md-2 col-xs-6 pa-0">
						<button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-3 col-xs-6">
			<a href="<?php echo site_url('member/admin/excel_export/'); ?>" class="btn btn-primary btn-xs pull-right mr-5">Dışa Aktar (Excel)</a>
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
			<i class="zmdi zmdi-block pr-15 pull-left"></i><p class="pull-left"><?php echo $this->session->flashdata('error_message'); ?></p>
			<div class="clearfix"></div>
		</div>
	<?php endif; ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">			
					<div class="panel-body">
						<div class="table-wrap">
							<div class="table-responsive">
								<table class="table table-hover mb-0">
									<thead>
										<tr>
											<th>Ad Soyad</th>
											<th>E-Mail</th>
											<th>Telefon</th>
											<th>Aktif</th>
											<th>İşlemler</th>
										</tr>
									</thead>
									<tbody id="sortable">
										<?php $i=1; foreach ($page as $item): ?>										
											<tr id="listItem_<?php echo $item->id; ?>">
												<td class="fullname"><?php echo $item->name." ".$item->name; ?></td>
												<td class="email"><?php echo $item->email; ?></td>
												<td class="phone"><?php echo $item->phone; ?></td>
												<td><input type="checkbox" onchange="window.location.href='<?php echo site_url("member/admin/change_active/".$item->id."/".$item->active); ?>'" class="js-switch js-switch-1" <?php echo($item->active == 1)?'checked="checked"':""; ?> data-color="#469408" data-size="small"/></td>
												<td>
													<a href="<?php echo site_url('member/admin/edit_record/'.$item->id); ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Düzenle"><i class="fa fa-pencil"></i></a>
													<a onclick="delete_confirm('<?php echo site_url('member/admin/delete_record/'.$item->id); ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Sil"><i class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php $i++; endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
						<?php if(!@$_GET["s"] && !@$_GET["s_type"] && !@$_GET["s_city"]): ?>
							<select class="btn btn-xs btn-success btn-outline pull-right mt-15 ml-15" onchange="location = this.value;">
								<?php for($p = 1; $p <= ceil($total_count/$this->pagination->per_page); $p++): ?>
								<option value="<?php echo site_url("member/admin/index?per_page=".(($p*$this->pagination->per_page)-$this->pagination->per_page)); ?>" <?php echo((@$_GET["per_page"]/$this->pagination->per_page)+1 == $p)?"selected":""; ?>><?php echo $p; ?></option>
								<?php endfor; ?>
							</select>
							<?php echo $this->pagination->create_links(); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $this->load->view('admin/layout/footer'); ?>
<?php $this->load->view('admin/layout/end'); ?>