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
		$sorgu = $this->db->get('regions');
		return $sorgu->row();
	}
	public function records()
	{
		$this->db->select('*');
		$sorgu = $this->db->get('regions');
		return $sorgu->result();
	}
	public function change_active($id, $active)
	{
		if($active == 0){$active = 1;}
		elseif($active == 1){$active = 0;}

		$data = array('active' => $active);
		$this->db->where('id',$id);
		$this->db->update('regions',$data);
	}
	public function get_all_city()
	{
		$this->db->select('*');
		$sorgu = $this->db->get('city');
		return $sorgu->result();
	}
	public function city_control($city_id)
	{
		$this->db->select('*');
		$this->db->where('city', $city_id);
		$sorgu = $this->db->get('regions');
		return $sorgu->row();
	}
	public function get_town($city_id)
	{
		$this->db->select('*');
		$this->db->where('city', $city_id);
		$sorgu = $this->db->get('town');
		return $sorgu->result();
	}
	public function get_regions($regions_id)
	{
		$this->db->select('*');
		$this->db->where('id', $regions_id);
		$sorgu = $this->db->get('regions');
		return $sorgu->row();
	}
	public function get_district($town_id)
	{
		$this->db->select('*');
		$this->db->where('town', $town_id);
		$sorgu = $this->db->get('district');
		return $sorgu->result();
	}

	public function add_record($post)
	{
		// şube için şifre oluşturuluyor.
		$character = "1234567890abcdefghijKLMNOPQRSTuvwxyzABCDEFGHIJklmnopqrstUVWXYZ0987654321";
		$password = '';
		for($i=0;$i<8;$i++)
		{
			$password .= $character{rand() % 72};
		}
		$this->db->set('title', $post["title"]);
		$this->db->set('address', $post["address"]);
		$this->db->set('email', $post["email"]);
		$this->db->set('password', $password);
		$this->db->set('phone', $post["phone"]);
		$this->db->set('open', $post["open"]);
		$this->db->set('close', $post["close"]);
		$this->db->set('district', '[""]');
		$this->db->insert('regions');
		return $this->db->insert_id();
	}
	public function edit_record($post,$id)
	{
		$data = array(
			'title' =>			$post['title'],
			'address' =>		$post['address'],
			'email' =>			$post['email'],
			'password' =>		$post['password'],
			'phone' =>			$post['phone'],
			'open' =>			$post['open'],
			'close' =>			$post['close'],
			'api_key' =>		$post['api_key'],
			'secret_key' =>		$post['secret_key']
		);
		$this->db->where('id',$id);
		$records = $this->db->update('regions',$data);
		return true;
	}
	public function add_regions($post)
	{
		$data = array(
			'city' =>			$post['city'],
			'town' =>			json_encode($post['town']),
			'district' =>		json_encode($post['district'])
		);
		$this->db->where('id',$post["regions_id"]);
		$records = $this->db->update('regions',$data);
		return true;
	}
	public function edit_regions($post)
	{
		$data = array(
			'town' =>			json_encode($post['town']),
			'district' =>		json_encode($post['district'])
		);
		$this->db->where('id',$post["regions_id"]);
		$records = $this->db->update('regions',$data);
		return true;
	}
	public function update_min_order($post,$id)
	{
		$data = array(
			'district_min_order' =>			json_encode($post['district_min_order'])
		);
		$this->db->where('id',$id);
		$records = $this->db->update('regions',$data);
		return true;
	}
	public function get_orders($region_id)
	{
		$this->db->select('*');
		$this->db->where('region_id', $region_id);
		$sorgu = $this->db->get('order');
		return $sorgu->result();
	}
	public function report_detail($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$records = $this->db->get('order');
		return $records->row_array();
	}
}
