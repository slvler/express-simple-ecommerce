<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

	<div class="row heading-bg">
		<div class="col-xs-12">
			<h5 class="txt-dark">Genel Ayarlar</h5>
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
		<form method="post" enctype="multipart/form-data">
			<div class="col-sm-8 col-xs-12">
				<div class="panel panel-default card-view">
					<div class="panel-wrapper collapse in">			
						<div class="panel-body">
							<div class="form-wrap">
								<div  class="pills-struct">
									<ul role="tablist" class="nav nav-pills">
										<?php foreach($this->data["all_languages"] as $item): ?>
										<li class="<?php echo($item->default == 1)?"active":""; ?>" role="presentation"><a aria-expanded="<?php echo($item->default == 1)?"true":"false"; ?>" data-toggle="tab" role="tab" href="#lang_<?php echo $item->lang ?>"><?php echo $item->language ?></a></li>
										<?php endforeach; ?>
									</ul>
									<div class="tab-content">
										<?php foreach($this->data["all_languages"] as $item): ?>
										<div id="lang_<?php echo $item->lang ?>" class="tab-pane fade <?php echo($item->default == 1)?"active in":""; ?>" role="tabpanel">
											<div class="row">
												<div class="col-md-6 col-xs-12">
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[logo]">Logo</label>
														<input type="file" class="form-control" id="<?php echo $item->lang ?>[logo]" name="<?php echo $item->lang ?>_logo" />
													</div>
													<?php if(! @$page[$item->lang]['logo'] == ""): ?>
														<img src="<?php echo @$page[$item->lang]['logo']; ?>" class="img-responsive thumbnail" />
													<?php endif; ?>
												</div>
												<div class="col-md-6 col-xs-12">
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[logo2]">Logo <small>(2)</small></label>
														<input type="file" class="form-control" id="<?php echo $item->lang ?>[logo2]" name="<?php echo $item->lang ?>_logo2" />
													</div>
													<?php if(! @$page[$item->lang]['logo2'] == ""): ?>
														<img src="<?php echo @$page[$item->lang]['logo2']; ?>" class="img-responsive thumbnail" />
													<?php endif; ?>
												</div>
											</div>
											<hr />
											<div class="row">
												<div class="col-md-8 col-xs-12">
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[title]">Site Başlığı</label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[title]" name="<?php echo $item->lang ?>[title]" placeholder="Site Başlığı" value="<?php echo @$page[$item->lang]['title'] ?>" />
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[description]">Sayfa Tanımı <small>(Description)</small></label>
														<textarea class="form-control" id="<?php echo $item->lang ?>[description]" name="<?php echo $item->lang ?>[description]" placeholder="Sayfa Tanımı" rows="3"><?php echo @$page[$item->lang]['description']; ?></textarea>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[keywords]">Anahtar Kelimeler <small>(Keywords)</small></label>
														<textarea class="form-control" id="<?php echo $item->lang ?>[keywords]" name="<?php echo $item->lang ?>[keywords]" placeholder="Anahtar Kelimeler"><?php echo @$page[$item->lang]['keywords']; ?></textarea>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[footer_text]">Footer Yazısı</label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[footer_text]" name="<?php echo $item->lang ?>[footer_text]" placeholder="Footer Yazısı" value="<?php echo @$page[$item->lang]['footer_text'] ?>" />
													</div>
												</div>
												<div class="col-md-4 col-xs-12">
													<h5 class="mb-20">Sosyal Medya Adresleri</h5>
													<div class="form-group">
														<input type="text" class="form-control" name="<?php echo $item->lang ?>[social_facebook_url]" placeholder="Facebook" value="<?php echo @$page[$item->lang]['social_facebook_url'] ?>" />
													</div>
													<div class="form-group">
														<input type="text" class="form-control" name="<?php echo $item->lang ?>[social_instagram_url]" placeholder="Instagram" value="<?php echo @$page[$item->lang]['social_instagram_url'] ?>" />
													</div>
													<div class="form-group">
														<input type="text" class="form-control" name="<?php echo $item->lang ?>[social_twitter_url]" placeholder="Twitter" value="<?php echo @$page[$item->lang]['social_twitter_url'] ?>" />
													</div>
													<div class="form-group">
														<input type="text" class="form-control" name="<?php echo $item->lang ?>[social_youtube_url]" placeholder="Youtube" value="<?php echo @$page[$item->lang]['social_youtube_url'] ?>" />
													</div>
													<div class="form-group">
														<input type="text" class="form-control" name="<?php echo $item->lang ?>[social_googleplus_url]" placeholder="Google Plus" value="<?php echo @$page[$item->lang]['social_googleplus_url'] ?>" />
													</div>
													<div class="form-group">
														<input type="text" class="form-control" name="<?php echo $item->lang ?>[social_linkedin_url]" placeholder="Linkedin" value="<?php echo @$page[$item->lang]['social_linkedin_url'] ?>" />
													</div>
													<div class="form-group">
														<input type="text" class="form-control" name="<?php echo $item->lang ?>[social_pinterest_url]" placeholder="Pinterest" value="<?php echo @$page[$item->lang]['social_pinterest_url'] ?>" />
													</div>
												</div>
											</div>
										</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4 col-xs-12">
				<div class="panel panel-default card-view">
					<div class="panel-wrapper collapse in">			
						<div class="panel-body">
							<div class="form-wrap">
								<?php if($this->session->userdata['logged_in']["power"] == "root"): ?>
								<div class="checkbox checkbox-success checkbox-circle">
									<input id="general[page_cache]" name="general[page_cache]" type="checkbox" <?php echo(@$page[$this->data["default_lang"]->lang]['page_cache'] == 1)?'checked="checked"':""; ?>>
									<label for="general[page_cache]">Sayfa Çerezleri</label>
								</div>	
								<div class="checkbox checkbox-success checkbox-circle">
									<input id="general[css_js_cache]" name="general[css_js_cache]" type="checkbox" <?php echo(@$page[$this->data["default_lang"]->lang]['css_js_cache'] == 1)?'checked="checked"':""; ?>>
									<label for="general[css_js_cache]">CSS & JS Çerezleri</label>
								</div>								
								<hr />
								<div class="form-group mb-30">
									<label class="control-label mb-10 text-left">Arama Yapılabilecek Modüller</label>
									<div class="row">
									<?php $searchModules = ["content","product"] ?>
									<?php $i=0; foreach($searchModules as $searchModule): ?>
									<?php if($this->db->table_exists($searchModule)): ?>
									<div class="col-md-4 col-xs-6">
										<div class="checkbox checkbox-success">
											<input id="searchModule<?php echo $i ?>" type="checkbox" name="general[search_module][]" value="<?php echo $searchModule ?>" <?php echo (strstr(@$page[$this->data["default_lang"]->lang]['search_module'],$searchModule)?"checked":""); ?> />
											<label for="searchModule<?php echo $i ?>"><?php echo $searchModule ?></label>
										</div>
									</div>
									<?php endif; ?>
									<?php $i++; endforeach; ?>
									</div>
								</div>
								<hr />
								<?php endif; ?>
								<div class="form-group">
									<label class="control-label mb-10 text-left" for="general[google_analytics]">Google Head Kodları</label>
									<textarea class="form-control" id="general[google_analytics]" name="general[google_analytics]" placeholder="Google Analytics Kodları" rows="10"><?php echo @$page[$this->data["default_lang"]->lang]['google_analytics']; ?></textarea>
								</div>
								<div class="form-group">
									<label class="control-label mb-10 text-left" for="general[yandex_metrica]">Yandex / Facebook Head Kodları</label>
									<textarea class="form-control" id="general[yandex_metrica]" name="general[yandex_metrica]" placeholder="Yandex Metrica / Facebook Pixel Kodları" rows="10"><?php echo @$page[$this->data["default_lang"]->lang]['yandex_metrica']; ?></textarea>
								</div>
								<hr />
								<?php if($this->session->userdata['logged_in']["power"] == "root"): ?>
								<h5 class="mb-20">SMTP Bilgileri</h5>
								<div class="form-group">
									<input type="text" class="form-control" name="general[smtp_host]" placeholder="SMTP Hostu" value="<?php echo @$page[$this->data["default_lang"]->lang]['smtp_host'] ?>" />
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="general[smtp_port]" placeholder="SMTP Portu" value="<?php echo @$page[$this->data["default_lang"]->lang]['smtp_port'] ?>" />
								</div>
								<div class="form-group">
									<input type="email" class="form-control" name="general[smtp_user]" placeholder="SMTP Mail Adresi" value="<?php echo @$page[$this->data["default_lang"]->lang]['smtp_user'] ?>" />
								</div>
								<div class="form-group">
									<input type="password" class="form-control" name="general[smtp_pass]" placeholder="SMTP Şifresi" value="<?php echo @$page[$this->data["default_lang"]->lang]['smtp_pass'] ?>" />
								</div>
								<?php endif; ?>
								<div class="form-group">
									<textarea rows="3" class="form-control" name="general[smtp_to]" placeholder="Gönderilecek Adresler (aralarında virgül kullanarak birden fazla eposta adresi girebilirsiniz)"><?php echo @$page[$this->data["default_lang"]->lang]['smtp_to'] ?></textarea>
								</div>
								<div class="form-group clearfix">
									<button type="submit" class="btn btn-success pull-right">Kaydet</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	
<?php $this->load->view('admin/layout/footer'); ?>
<?php $this->load->view('admin/layout/end'); ?>