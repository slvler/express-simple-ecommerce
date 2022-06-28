<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		// Yönetim paneli kullanıcı girişi kontrolü
		if (! isset($this->session->userdata['logged_in'])) { redirect('/admin/login', 'refresh'); }

		$this->load->model('regions/Admin_model');
		$this->load->helper('img_upload');
	}

	public function index()
	{
		$this->load->library('migration');
		if ($this->migration->init_module("regions")) { $this->migration->current(); }
		$this->data['page'] = (array) $this->Admin_model->records();
		$this->data["city"] = (array) $this->Admin_model->get_all_city();

		$this->load->view('regions/admin/admin', $this->data);
	}
	public function change_active()
	{
		$id = (int)($this->uri->segment(4));
		$active = (int)($this->uri->segment(5));

		$this->Admin_model->change_active($id, $active);
		$this->session->set_flashdata("success_message", "Aktiflik durumu değiştirildi!");
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function add_record()
	{
		if($_POST){
			$add_id = $this->Admin_model->add_record($this->input->post());
			$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
			redirect('/regions/admin/index/', 'refresh');
		}else{
			$this->load->view('regions/admin/add_record');
		}
	}
	public function edit_record()
	{
		$id = (int)($this->uri->segment(4));
		if($_POST){
			$add_id = $this->Admin_model->edit_record($this->input->post(),$id);
			$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
			redirect('/regions/admin/edit_record/'.$id, 'refresh');
		}else{
			$this->data['page'] = (array) $this->Admin_model->record($id);
			$this->load->view('regions/admin/edit_record', $this->data);
		}
	}
	public function add_regions()
	{
		if (@$_GET) {
			// Şehir seçildikten sonra ilçe seçme işlemleri.
			if (@$_GET["city"] && !@$_GET["town"]) {
				$this->data["town"] = $this->Admin_model->get_town($this->input->get("city"));
			}elseif(@$_GET["city"] && @$_GET["town"]){
				// İlçe seçildikten sonra semt seçme işlemleri.
				foreach ($this->input->get("town") as $item) {
					$this->data["district"][$item] = $this->Admin_model->get_district($item);
				}
			}
		}
		if ($_POST) {
			$this->Admin_model->add_regions($this->input->post());
			$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
			redirect('regions/admin','refresh');
		}
		$this->data["city"] = (array) $this->Admin_model->get_all_city();
		$this->load->view('regions/admin/add_regions', $this->data);
	}
	public function edit_regions()
	{
		if (@$_GET) {
			// ilçe düzenleme işlemleri.
			if (@$_GET["city"] && !@$_GET["town"]) {
				$this->data["town"] = $this->Admin_model->get_town($this->input->get("city"));
				$this->data["regions_town"] = $this->Admin_model->get_regions($this->input->get("regions_id"));
				$this->data["regions_town"] = json_decode($this->data["regions_town"]->town);
				$this->data["town_result"] = '';
				foreach ($this->data["regions_town"] as $value) {
					$this->data["town_result"] .= "'".$value."',";
				}
				$this->data["town_result"] = rtrim($this->data["town_result"],",");
			}elseif(@$_GET["city"] && @$_GET["town"]){
				// semt düzenleme işlemleri.
				foreach ($this->input->get("town") as $item) {
					$this->data["district"][$item] = $this->Admin_model->get_district($item);
				}
				$this->data["regions_district"] = $this->Admin_model->get_regions($this->input->get("regions_id"));
				$this->data["regions_district"] = json_decode($this->data["regions_district"]->district);
				foreach ($this->data["regions_district"] as $key => $value) {
					$this->data["district_result"][$key] = '';
					foreach ($value as $value2) {
						$this->data["district_result"][$key] .= "'".$value2."',";
					}
					$this->data["district_result"][$key] = rtrim($this->data["district_result"][$key],",");
				}
			}
		}
		if ($_POST) {
			$this->Admin_model->edit_regions($this->input->post());
			$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
			redirect('regions/admin','refresh');
		}
		$this->load->view('regions/admin/edit_regions', $this->data);
	}
	public function update_min_order()
	{
		$id = (int)($this->uri->segment(4));
		if($_POST){
			$add_id = $this->Admin_model->update_min_order($this->input->post(),$id);
			$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
			redirect('/regions/admin/update_min_order/'.$id, 'refresh');
		}else{
			$this->data['page'] = (array) $this->Admin_model->record($id);
			$this->load->view('regions/admin/update_min_order', $this->data);
		}
	}
	public function get_town()
	{
		if ($_POST) {
			$town = $this->Admin_model->get_town($this->input->post("city_id"));
			$data = '<option value="">İlçe Seçiniz</option>';
			foreach ($town as $row) {
				$data .= '
				<option value="'.$row->town_id.'">'.$row->title.'</option>
				';
			}
			echo $data;exit;
		}
	}
	public function report()
	{
		$id = (int)($this->uri->segment(4));
		$this->data['region'] = $this->Admin_model->record($id);
		$this->data['orders'] = (array) $this->Admin_model->get_orders($id);
		// toplam sipariş tutarları alınıyor.
		$this->data['total_order_price'] = 0;
		$this->data['total_order_discount_price'] = 0;
		foreach ($this->data['orders'] as $row) {
			$this->data['total_order_price'] += $row->total;
			$this->data['total_order_discount_price'] += $row->discount_price;
		}		
		$this->load->view('regions/admin/report', $this->data);
	}
	public function report_detail()
	{
		$id = (int)($this->uri->segment(4));
		
		$this->data['detail'] = $this->Admin_model->report_detail($id);
		$this->load->view('regions/admin/report_detail', $this->data);
	}
}
