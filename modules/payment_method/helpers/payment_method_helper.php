<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_payment_methods')){
	function get_payment_methods()
	{
		global $CI;
		$CI->load->model('payment_method/Payment_method_model');
		$data = $CI->Payment_method_model->get_payment_method();
		return $data;
	}
}