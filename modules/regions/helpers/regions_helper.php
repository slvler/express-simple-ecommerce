<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('get_city_regions')){
	function get_city_regions()
	{
		global $CI;
		$CI->load->model('regions/Regions_model');
		$data = $CI->Regions_model->get_city();
		return $data;
	}
}
if(!function_exists('get_town_regions')){
	function get_town_regions($city)
	{
		global $CI;
		$CI->load->model('regions/Regions_model');
		$data = $CI->Regions_model->get_town($city);
		return $data;
	}
}
if(!function_exists('get_region_data')){
	function get_region_data($id)
	{
		global $CI;
		$CI->load->model('regions/Regions_model');
		$data = $CI->Regions_model->record($id);
		return $data;
	}
}
if(!function_exists('get_all_regions')){
	function get_all_regions()
	{
		global $CI;
		$CI->load->model('regions/Regions_model');
		$data = $CI->Regions_model->get_regions();
		return $data;
	}
}
if(!function_exists('get_home_regions')){
	function get_home_regions()
	{
		global $CI;
		$CI->load->model('regions/Regions_model');
		$regions = $CI->Regions_model->get_regions();
		$arr_regions = array();
		foreach ($regions as $item) {
			if (@json_decode($item->district)) {
				foreach (json_decode($item->district) as $value) {
					if (@$value) {
						foreach ($value as $row) {
							if ($row==$CI->session->userdata("locationData")["district"]) {
								array_push($arr_regions, $item);
							}
						}
					}
				}
			}
		}
		return $arr_regions;
	}
}
