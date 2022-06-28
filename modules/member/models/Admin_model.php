<?php
class admin_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}

	public function page($per_page = 0, $page_number = 0)
	{
		$this->db->select('*');
		$this->db->order_by('id desc');
		if($per_page > 0 || $page_number > 0){			
			$this->db->limit($per_page, $page_number);
		}
		$records = $this->db->get('member');
		return $records->result();
	}

	public function record($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$records = $this->db->get('member');
		return $records->row();
	}
	
    public function change_active($id, $active)
	{
		if($active == 0){$active = 1;}
		elseif($active == 1){$active = 0;}
		
		$data = array('active' => $active);
		$this->db->where('id',$id);
		$this->db->update('member',$data);
    }
	
    public function edit_record($id, $post)
	{
		$data = array(
			'name'		=> $post["name"],
			'surname'	=> $post["surname"],
			'email'		=> $post["email"],
			'tcno'		=> $post["tcno"],
			'phone'		=> $post["phone"]
		);
		if(@$post["password"]){
			$data["password"] = md5($post["password"]);
		}
		$this->db->where('id',$id);
		$records = $this->db->update('member',$data);
		return true;
    }

	public function delete_record($id)
	{		
		$this->db->where('id', $id);
		$this->db->delete('member');
		
		return true;
	}
	
	public function recCount($active = null)
	{
		$this->db->from('member');
		if(is_int($active)){
			$this->db->where('active', $active);
		}
		return $this->db->count_all_results();
    }
	
	public function search($text = null)
	{
		$this->db->select('*');
		$this->db->where("(name like '%".$text."%' OR surname like '%".$text."%' OR email like '%".$text."%' OR phone like '%".$text."%' OR address like '%".$text."%')");
		$this->db->order_by('id desc');
		$records = $this->db->get('member');
		return $records->result();
	}
}