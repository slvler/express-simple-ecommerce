<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('all_members')){
	function all_members()
	{
		global $CI;
		$CI->load->model('member/Member_model');
		$data = (array) $CI->Member_model->all_members();
		return $data;
	}
}

if(!function_exists('get_member')){
	function get_member($id)
	{
		global $CI;
		$CI->load->model('member/Member_model');
		$data = (array) $CI->Member_model->member($id);
		return $data;
	}
}

if(!function_exists('get_member_address')){
	function get_member_address($id)
	{
		global $CI;
		$CI->load->model('member/Member_model');
		$data = (array) $CI->Member_model->address_list($id);
		return $data;
	}
}

if(!function_exists('get_address')){
	function get_address($member_id,$address_id)
	{
		global $CI;
		$CI->load->model('member/Member_model');
		$data = (array) $CI->Member_model->get_address($member_id,$address_id);
		return $data;
	}
}

if(!function_exists('get_member_session')){
	function get_member_session($value)
	{
		global $CI;
		$CI->load->model('member/Member_model');
		$data = (array) $CI->Member_model->get_member_session($CI->session->userdata['member_logged_in']["email"]);		
		return $data[$value];
	}
}

if(!function_exists('all_city')){
	function all_city()
	{
		global $CI;
		$CI->load->model('member/Member_model');
		$data = (array) $CI->Member_model->all_city();
		return $data;
	}
}

if(!function_exists('get_city')){
	function get_city($sehir_id)
	{
		global $CI;
		$CI->load->model('member/Member_model');
		$data = (array) $CI->Member_model->city($sehir_id);
		return $data;
	}
}

if(!function_exists('all_town')){
	function all_town($sehir_id)
	{
		global $CI;
		$CI->load->model('member/Member_model');
		$data = (array) $CI->Member_model->all_town($sehir_id);
		return $data;
	}
}

if(!function_exists('get_town')){
	function get_town($ilce_id)
	{
		global $CI;
		$CI->load->model('member/Member_model');
		$data = (array) $CI->Member_model->town($ilce_id);
		return $data;
	}
}

if(!function_exists('all_district')){
	function all_district($ilce_id)
	{
		global $CI;
		$CI->load->model('member/Member_model');
		$data = (array) $CI->Member_model->all_district($ilce_id);
		return $data;
	}
}

if(!function_exists('get_district')){
	function get_district($mahalle_id)
	{
		global $CI;
		$CI->load->model('member/Member_model');
		$data = (array) $CI->Member_model->district($mahalle_id);
		return $data;
	}
}
if(!function_exists('get_city_title')){
	function get_city_title($city_id)
	{
		global $CI;
		$CI->load->model('member/Member_model');
		$data = $CI->Member_model->get_city_title($city_id);
		if($data != NULL){
			return $data->title;
		}else{
			return "";
		}
	}
}
if(!function_exists('get_town_title')){
	function get_town_title($town_id)
	{
		global $CI;
		$CI->load->model('member/Member_model');
		$data = $CI->Member_model->get_town_title($town_id);
		if($data != NULL){
			return $data->title;
		}else{
			return "";
		}
	}
}
if(!function_exists('get_district_title')){
	function get_district_title($district_id)
	{
		global $CI;
		$CI->load->model('member/Member_model');
		$data = $CI->Member_model->get_district_title($district_id);
		if($data != NULL){
			return $data->title;
		}else{
			return "";
		}
	}
}