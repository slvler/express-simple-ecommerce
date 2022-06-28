<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		// Yönetim paneli kullanıcı girişi kontrolü
		if (! isset($this->session->userdata['logged_in'])) { redirect('/admin/login', 'refresh'); }
		
		$this->load->model('payment_method/Admin_model');
		$this->load->helper('img_upload');
	}
	
	public function index()
	{
		$this->load->library('migration');
		if ($this->migration->init_module("payment_method")) { $this->migration->current(); }
		$this->data['page'] = (array) $this->Admin_model->records();
		
		$this->load->view('payment_method/admin/admin', $this->data);
	}

	public function change_active()
	{
		$id = (int)($this->uri->segment(4));
		$active = (int)($this->uri->segment(5));
		
		$this->Admin_model->change_active($id, $active);
		$this->session->set_flashdata("success_message", "Aktiflik durumu değiştirildi!");
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function change_active_region()
	{
		$id = (int)($this->uri->segment(4));
		$active = (int)($this->uri->segment(5));
		// işlemi yapan şubenin ödeme method bilgileri getiriliyor.
		$region_payment_method = $this->Admin_model->get_region($this->session->userdata("logged_in")["id"])->invisible_payment_method;
		$this->Admin_model->change_active_region($id, $active,json_decode($region_payment_method));
		$this->session->set_flashdata("success_message", "Aktiflik durumu değiştirildi!");
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function add_record()
	{
		if($_POST){
			$add_id = $this->Admin_model->add_record($this->input->post());
			$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
			redirect('/payment_method/admin/index/', 'refresh');
		}else{
			$this->load->view('payment_method/admin/add_record');
		}
	}

	public function edit_record()
	{
		$id = (int)($this->uri->segment(4));
		if($_POST){
			$add_id = $this->Admin_model->edit_record($this->input->post(),$id);
			$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
			redirect('/payment_method/admin/edit_record/'.$id, 'refresh');
		}else{
			$this->data['page'] = (array) $this->Admin_model->record($id);
			$this->load->view('payment_method/admin/edit_record', $this->data);
		}
	}
}