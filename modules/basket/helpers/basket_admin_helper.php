<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('basket_item_count')){
	function basket_item_count()
	{
		global $CI;
		return $CI->Admin_model->order_for_dash();
	}
}