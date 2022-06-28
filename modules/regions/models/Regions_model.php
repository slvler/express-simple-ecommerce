<?php
class Regions_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
    }
	
    public function record($id)
	{
		$this->db->select('*');
      	$this->db->where('id',$id);
		$sorgu = $this->db->get('regions');
		return $sorgu->row();
    }
    public function get_regions()
	{
		$this->db->select('*');
		$sorgu = $this->db->get('regions');
		return $sorgu->result();
    }
    public function get_city()
	{
		$this->db->select('city');
		$sorgu = $this->db->get('regions');
		return $sorgu->result();
    }
    public function get_town($city)
	{
		$this->db->select('town');
		$this->db->where('city',$city);
		$sorgu = $this->db->get('regions');
		return $sorgu->row();
    }
    public function get_district($city)
	{
		$this->db->select('district');
		$this->db->where('city',$city);
		$sorgu = $this->db->get('regions');
		return $sorgu->row();
    }
	
    public function lang_id_records($lang_id)
	{
		$this->db->select('*');
		$this->db->where('lang_id',$lang_id);
		$records = $this->db->get('regions');
		return $records->result();
    }
}
