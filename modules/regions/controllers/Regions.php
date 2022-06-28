<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Regions extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('regions/Regions_model');
		$this->load->helper('member/member');
	}
	
	public function index()
	{
		
	}

	public function get_town()
	{
		if ($_POST) {
			$town = $this->Regions_model->get_town($this->input->post("city_id"));
			$town = json_decode($town->town);
			$data = '<option value="">İlçe Seçiniz</option>';
			foreach ($town as $row) {
				$data .= '
				<option value="'.$row.'" data-city="'.$this->input->post("city_id").'">'.get_town_title($row).'</option>
				';
			}
			echo $data;exit;
		}
	}

	public function get_district()
	{
		if ($_POST) {
			$district = $this->Regions_model->get_district($this->input->post("city_id"));
			$district = json_decode($district->district);
			$town_id = $this->input->post("town_id");
			$data = '';
			foreach ($district->$town_id as $row) {
				$data .= '
				<option value="'.$row.'">'.get_district_title($row).'</option>
				';
			}
			echo $data;exit;
		}
	}
}