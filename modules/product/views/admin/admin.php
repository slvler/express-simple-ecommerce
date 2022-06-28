<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">Ürünler</h5>
		</div>
		<div class="col-md-4 col-xs-8">
			<form action="<?php echo site_url("product/admin"); ?>" method="get">
				<div class="row">
					<div class="col-md-8 col-xs-12">
						<div class="row">
							<input type="text" placeholder="Ürünlerde Ara" class="form-control" name="s" value="<?php echo @$_GET["s"] ?>" autocomplete="off" />
						</div>
					</div>
					<div class="col-md-3 col-xs-9">
						<div class="row">
							<select class="form-control" name="c">
								<option value="">Hepsi</option>
								<option value="category" <?php echo(@$_GET["c"] == "category")?"selected":""; ?>>Kategori</option>
								<option value="product" <?php echo(@$_GET["c"] == "product")?"selected":""; ?>>Ürün</option>
							</select>
						</div>
					</div>	
					<div class="col-md-1 col-xs-3">
						<div class="row">
							<button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
						</div>
					</div>				
				</div>
			</form>
		</div>
		<div class="col-md-4 col-xs-4">
			<a href="<?php echo site_url('product/admin/add_record/'.(int)($this->uri->segment(4))); ?>" class="btn btn-primary btn-xs pull-right">Yeni Kayıt</a>
		</div>
	</div>
	<?php if (!empty ($this->session->flashdata('success_message'))): ?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<i class="zmdi zmdi-check pr-15 pull-left"></i><p class="pull-left"><?php echo $this->session->flashdata('success_message'); ?></p> 
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
										<th></th>
										<th>#</th>
										<th>Başlık</th>
										<th>Sayfa Tipi</th>
										<th>Link</th>
										<th>Aktif</th>
										<th>İşlemler</th>
									  </tr>
									</thead>
									<tbody id="sortable">
									<?php foreach ($page as $item): ?>										
										<tr id="listItem_<?php echo $item->id; ?>">
											<td><div class="btn btn-xs btn-default handle"><i class="fa fa-arrows"></i></div></td>
											<td><?php echo $item->id; ?></td>
											<td><?php echo $item->title; ?></td>
											<td>
												<?php echo($item->page_type == "category")?"Kategori":""; ?>
												<?php echo($item->page_type == "product")?"Ürün":""; ?>
											</td>
											<td><?php echo get_seo_url("product/index/".$item->id); ?></td>
											<td><input type="checkbox" onchange="window.location.href='<?php echo site_url("product/admin/change_active/".$item->id."/".$item->active); ?>'" class="js-switch js-switch-1" <?php echo($item->active == 1)?'checked="checked"':""; ?> data-color="#469408" data-size="small"/></td>
											<td>
												<a href="<?php echo site_url('product/admin/index/'.$item->id); ?>" class="btn btn-xs btn-<?php echo($item->page_type != "category")?"default":"primary"; ?> <?php echo($item->page_type != "category")?"disabled":""; ?>" data-toggle="tooltip" title="Alt İçerikler"><?php echo $item->child; ?> <i class="fa fa-level-down"></i></a>
												<a href="<?php echo site_url('product/admin/edit_record/'.$item->id); ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Düzenle"><i class="fa fa-pencil"></i></a>
												<a href="<?php echo get_seo_url("product/index/".$item->id); ?>" class="btn btn-xs btn-info" target="_blank" data-toggle="tooltip" title="Sayfayı Aç"><i class="fa fa-eye"></i></a>											
												<a onclick="delete_confirm('<?php echo site_url('product/admin/delete_record/'.$item->id); ?>')" class="btn btn-danger btn-xs <?php echo($item->child > 0)?"disabled":""; ?>" data-toggle="tooltip" title="Sil"><i class="fa fa-trash"></i></a>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php $this->load->view('admin/layout/footer'); ?>
<?php $this->load->view('admin/layout/end'); ?>

<script>
$( document ).ready(function() {
	$("#sortable").sortable({
		handle : '.handle',
		update : function () {
			var order = $('#sortable').sortable('serialize');
			window.location.href = "product/admin/update_list?"+order;
		}
	});
});
</script>