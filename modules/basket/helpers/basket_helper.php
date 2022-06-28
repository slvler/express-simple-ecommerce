<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// if(!function_exists('basket_item_count')){
	// function basket_item_count()
	// {
		// global $CI;
		// return count($CI->cart->contents());
	// }
// }
if(!function_exists('dashboard_order')){
	function dashboard_order($limit = 0)
	{
		global $CI;
		$CI->load->model('basket/Basket_model');
		return $CI->Basket_model->dashboard_order($limit);
	}
}
if(!function_exists('get_product_code')){
	function get_product_code($prod_code)
	{
		global $CI;
		$CI->load->model('basket/Basket_model');
		return $CI->Basket_model->get_product($prod_code);
	}
}