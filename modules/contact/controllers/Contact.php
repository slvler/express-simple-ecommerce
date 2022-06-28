<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('contact/Contact_model');
	}
	
	public function index()
	{
		if($_POST){
			$this->Contact_model->send_mail($this->input->post());
			$this->session->set_flashdata("success_message", "Mesajınız Gönderildi!");
			redirect($_SERVER['HTTP_REFERER']);
		}
		
		$url = explode("/", get_real_url($this->uri->segment(1)));
		$this->data['page'] = (array) $this->Contact_model->page($url[2]);
		$this->load->view('contact/index', $this->data);
	}
}