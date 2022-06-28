<?php
class Member_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('img_upload');
		$this->load->helper('doc_upload');
	}
	
	public function all_members()
	{
		$this->db->select('*');
		$this->db->where("active", 1);
		$this->db->order_by('id desc');
		$records = $this->db->get('member');
		return $records->result();
	}
	
	public function login($data)
	{
		$this->db->select('*');
		$this->db->from('member');
		$this->db->where("email", $data['email']);
		$this->db->where("password", md5($data['password']));
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->row()->id;
		} else {
			return NULL;
		}
	}

	public function get_member_session($email)
	{
		$this->db->select('*');
		$this->db->where('email',$email);
		$sorgu = $this->db->get('member');
		return $sorgu->row();
	}

	public function member($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$sorgu = $this->db->get('member');
		return $sorgu->row();
	}
	
	public function members()
	{
		$this->db->select('*');
		$sorgu = $this->db->get('member');
		return $sorgu->result();
	}

	public function add_user($post)
	{
		$this->db->set('email', $post['email']);
		$this->db->set('password', md5($post['password']));
		$this->db->set('name', $post["name"]);
		$this->db->set('surname', $post["surname"]);
		$this->db->set('tcno', $post["tcno"]);
		$this->db->set('created_date', date("Y-m-d H-i-s"));

		$this->db->insert('member');
		return true;
	}

	public function add_order_user($post,$password)
	{
		$this->db->set('email', $post['email']);
		$this->db->set('password', md5($password));
		$this->db->set('name', $post["name"]);
		$this->db->set('surname', $post["surname"]);
		$this->db->set('created_date', date("Y-m-d H-i-s"));
		$this->db->insert('member');
		$insert_id = $this->db->insert_id();

		$eb = 'Sayın '.$post["name"]." ".$post["surname"]."<br> Aşağıdaki bilgiler ile üyeliğiniz oluşturulmuştur.";
		$eb = $eb.'<br><br><p>E-posta adresiniz : '.$post["email"].'</p>';
		$eb = $eb.'<br><br><p>Şifreniz : '.$password.'</p>';
		$eb = $eb.'<br><br>'.settings("title");

		$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => settings("smtp_host"),
			'smtp_port' => settings("smtp_port"),
			'smtp_user' => settings("smtp_user"),
			'smtp_pass' => settings("smtp_pass"),
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'wordwrap'  => TRUE
		);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->initialize($config);
		$this->email->from($config['smtp_user'], settings("title"));
		$this->email->to($post["email"]);
		$this->email->subject('Özsüt\'e Hoşgeldiniz!');
		$this->email->message($eb);
		$this->email->send();

		return $insert_id;
	}

	public function create_secret_key($email)
	{
		$secret_key = md5(date('YmdHis')."-".$email);
		$data = array( 'secret_key' => $secret_key);
		$this->db->where('email',$email);
		$this->db->update('member',$data);
		
		$this->forgot_password_mail($email, $secret_key);
	}

	public function forgot_password_mail($email, $secret_key)
	{
		$eb = 'Şifrenizi sıfırlamak için aşağıdaki bağlantıya tıklayabilirsiniz. Şifre sıfırlama talebini siz oluşturmadıysanız eğer bu maili görmezden gelebilirsiniz.';
		$eb = $eb.'<br><br><a href="'.site_url("member/change_password").'?sk='.$secret_key.'">Şifre Sıfırlama Bağlantısı</a>';
		$eb = $eb.'<br><br>'.settings("title");

		$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => settings("smtp_host"),
			'smtp_port' => settings("smtp_port"),
			'smtp_user' => settings("smtp_user"),
			'smtp_pass' => settings("smtp_pass"),
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'wordwrap'  => TRUE
		);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->initialize($config);
		$this->email->from($config['smtp_user'], settings("title"));
		$this->email->to($email);
		$this->email->subject('Şifre Sıfırlama');
		$this->email->message($eb);
		
		return $this->email->send();
	}

	public function change_password($id,$password)
	{
		$data = array('password' =>  md5($password));
		$this->db->where('id',$id);
		$this->db->update('member',$data);
		
		return true;
	}

	public function relog_password($secret_key,$password)
	{
		$data = array('password' =>  md5($password));
		$this->db->where('secret_key',$secret_key);
		$this->db->update('member',$data);
		
		return true;
	}

	public function update($post, $id)
	{
		$data = array(
			'name'		=> $post['name'],
			'surname'	=> $post['surname'],
			'phone'		=> $post['phone'],
			'email'		=> $post['email'],
			'tcno'		=> $post['tcno'],
			'campaign'	=> (@$post['campaign']) ? 1 : 0
		);
		$this->db->where('id', $id);
		$this->db->update('member',$data);
		
		return true;
	}

	public function login_update($id, $total_login)
	{
		$data = array(
			'total_login'	=> $total_login+1,
			'last_login'	=> date("Y-m-d H-i-s")
		);
		$this->db->where('id', $id);
		$this->db->update('member',$data);
		
		return true;
	}
	
	public function orders()
	{
		$this->db->select('*');
		$this->db->join('member', 'member.id = order.member_id');
		$this->db->order_by('order.id desc');
		$this->db->where('member.email',$this->session->userdata['member_logged_in']["email"]);
		$records = $this->db->get('order');
		return $records->result();
	}

	public function city($city_id)
	{
		$this->db->select('*');
		$this->db->where('key', $city_id);
		$records = $this->db->get('city');
		return $records->row();
	}
	public function all_city()
	{
		$this->db->select('*');
		$this->db->order_by('title asc');
		$records = $this->db->get('city');
		return $records->result();
	}

	public function town($town_id)
	{
		$this->db->select('*');
		$this->db->where('key', $town_id);
		$records = $this->db->get('town');
		return $records->row();
	}

	public function all_town($city_id)
	{
		$this->db->select('*');
		$this->db->where('city',$city_id);
		$this->db->order_by('title asc');
		$records = $this->db->get('town');
		return $records->result();
	}

	public function district($district_id)
	{
		$this->db->select('*');
		$this->db->where('key', $district_id);
		$records = $this->db->get('district');
		return $records->row();
	}
	public function all_district($town_id)
	{
		$this->db->select('*');
		$this->db->where('town',$town_id);
		$this->db->order_by('title asc');
		$records = $this->db->get('district');
		return $records->result();
	}

	public function getLocation($post)
	{
		$this->db->select('*');
		$this->db->where($post['where'],$post['id']);
		$this->db->order_by('title asc');
		$records = $this->db->get($post['write']);
		return $records->result();
	}

	public function address_list($member_id)
	{
		$this->db->select('*');
		$this->db->where('member', $member_id);
		$this->db->order_by('id asc');
		$records = $this->db->get('member_address')->result();
		return $records;
	}


	public function get_address($member_id,$address_id)
	{
		$this->db->select('*');
		$this->db->where('member', $member_id);
		$this->db->where('id', $address_id);
		$sorgu = $this->db->get('member_address');
		return $sorgu->row();
	}

	public function newAddressAdd($member_id, $post)
	{
		$this->db->set("default", @$post['default']);
		$this->db->set("title", $post['title']);
		$this->db->set("name", $post['name']);
		$this->db->set("surname", $post['surname']);
		$this->db->set("email", $post['email']);
		$this->db->set("phone", $post['phone']);
		$this->db->set("city", $post['city']);
		$this->db->set("town", $post['town']);
		$this->db->set("district", $post['district']);
		$this->db->set("address", $post['address']);
		$this->db->set("tcno", $post['tcno']);
		$this->db->set('member', $member_id);
		$this->db->set('created_date', date('Y-m-d H:i:s'));
		$this->db->insert('member_address');
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function addressDelete($member_id,$address_id)
	{		
		$this->db->where('member', $member_id);
		$this->db->where('id', $address_id);
		$this->db->delete('member_address');
		return true;
	}

	public function addressDefault($member_id, $adress_id)
	{
		$data = array('default' => 0);
		$this->db->where('member', $member_id);
		$this->db->update('member_address',$data);

		$data = array('default' => 1);
		$this->db->where('id', $adress_id);
		$this->db->where('member', $member_id);
		$this->db->update('member_address',$data);
		return true;
	}

	public function addressUpdate($member_id, $adress_id, $data)
	{
		$data = array(
			'title' => $data['title'],
			'name' => $data['name'],
			'surname' => $data['surname'],
			'email' => $data['email'],
			'phone' => $data['phone'],
			'city' => $data['city'],
			'town' => $data['town'],
			'district' => $data['district'],
			'address' => $data['address'],
			'tcno' => $data['tcno']
		);
		$this->db->where('member', $member_id);
		$this->db->where('id', $adress_id);
		$this->db->update('member_address',$data);
		return true;
	}

	public function get_town_title($town_id)
	{
		$this->db->select('*');
		$this->db->where('key', $town_id);
		$sorgu = $this->db->get('town');
		return $sorgu->row();
	}
	public function get_district_title($district_id)
	{
		$this->db->select('*');
		$this->db->where('key', $district_id);
		$sorgu = $this->db->get('district');
		return $sorgu->row();
	}
	public function get_city_title($city_id)
	{
		$this->db->select('*');
		$this->db->where('key', $city_id);
		$sorgu = $this->db->get('city');
		return $sorgu->row();
	}
}