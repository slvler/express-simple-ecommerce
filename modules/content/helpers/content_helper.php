<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_contents')){
	function get_contents($id, $limit = 0)
	{
		global $CI;
		$CI->load->model('content/Content_model');
		$data = (array) $CI->Content_model->child(get_lang_id_record($id, "content", $CI->data["default_lang"]->lang)->id, $limit);
		return $data;
	}
}
	
if(!function_exists('get_content')){
	function get_content($id)
	{
		global $CI;
		$CI->load->model('content/Content_model');
		$data = (array) $CI->Content_model->subrecord(get_lang_id_record($id, "content", $CI->session->userdata("lang"))->id);
		return $data;
	}
}

	// function videos($id)
	// {
		// global $CI;
		// $CI->load->model('content/Content_model');
		// $data = (array) $CI->Content_model->video($id);
		// return $data;
	// }

if(!function_exists('get_images')){
	function get_images($id, $limit = 0)
	{
		global $CI;
		$CI->load->model('content/Content_model');
		$data = (array) $CI->Content_model->gallery_images($id, $limit);
		if (!$data) {
			$data = (array) $CI->Content_model->gallery_images(get_lang_id_record($id, "content", $CI->data["default_lang"]->lang)->id, $limit);
		}
		return $data;
	}
}

if(!function_exists('all_contents_for_menu')){
	function all_contents_for_menu($id, $lang)
	{
		global $CI;
		$CI->load->model('content/Content_model');
		if($id > 0){
			$data = (array) $CI->Content_model->records_for_menu(get_lang_id_record($id, 'content', $CI->session->userdata('lang'))->id, $lang);
		}else{
			$data = (array) $CI->Content_model->records_for_menu($id, $lang);
		}
		return $data;
	}
}