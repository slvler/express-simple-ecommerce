<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_method extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('payment_method/Payment_method_model');
	}
	
	public function index()
	{
		
	}
}