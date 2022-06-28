<?php
class Admin_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('img_upload');
	}
	
	public function record($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$sorgu = $this->db->get('payment_method');
		return $sorgu->row();
	}

	public function records()
	{
		$this->db->select('*');
		$sorgu = $this->db->get('payment_method');
		return $sorgu->result();
	}

	public function change_active($id, $active)
	{
		if($active == 0){$active = 1;}
		elseif($active == 1){$active = 0;}
		
		$data = array('active' => $active);
		$this->db->where('id',$id);
		$this->db->update('payment_method',$data);
	}
	
	public function add_record($post)
	{
		$this->db->set('title', $post["title"]);
		$this->db->insert('payment_method');

		return $this->db->insert_id();
	}

	public function edit_record($post,$id)
	{
		$data = array(
			'title' =>			$post['title']
		);

		$this->db->where('id',$id);
		$records = $this->db->update('payment_method',$data);
		return true;
	}

	public function get_region($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$sorgu = $this->db->get('regions');
		return $sorgu->row();
	}

	public function change_active_region($id, $active,$region_payment_method)
	{
		if (!$region_payment_method) {
			$region_payment_method = array();
		}
		if($active == 0){
			// method listeye eklenecek.
			array_push($region_payment_method, $id);
		}elseif($active == 1){
			// method listeden silinecek
			foreach ((array)$region_payment_method as $key => $row) {
				if ($row==$id) {
					unset($region_payment_method[$key]);
				}
			}
		}
		// print_r($region_prod);exit;
		$data = array('invisible_payment_method' => json_encode($region_payment_method));
		$this->db->where('id',$this->session->userdata("logged_in")["id"]);
		$this->db->update('regions',$data);
	}

}