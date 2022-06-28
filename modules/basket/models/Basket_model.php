<?php
class Basket_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function lang_id_record($lang_id, $lang)
	{
		$this->db->select('*');
		$this->db->where('lang_id',$lang_id);
		$this->db->where('lang',$lang);
		$records = $this->db->get('product');
		return $records->row();
	}

	public function get_product($prod_code)
	{
		$this->db->select('*');
		$this->db->where('prod_code',$prod_code);
		$records = $this->db->get('product');
		return $records->row_array();
	}

	public function add_order($total_price,$discount_price,$basket_note,$post,$address_id,$member_id, $paymresult, $orderkey,$status,$failed_text){
		$this->db->set('order_key',$orderkey);
		$this->db->set('member_id', $member_id);
		$this->db->set('region_id', $this->session->userdata("branchData")["id"]);
		$this->db->set('address_id', $address_id);
		$this->db->set('products', json_encode($this->cart->contents(), true));
		$this->db->set('note', @$basket_note);
		$this->db->set('installment', @$this->session->userdata('installment'));
		$this->db->set('total', $this->cart->format_number($total_price,2));
		$this->db->set('discount_price', number_format($discount_price,2));
        $this->db->set('ip_address', $this->input->ip_address());
		$this->db->set('date', date("Y-m-d H:i:s"));
		$this->db->set('payment_status', $paymresult);
		$this->db->set('status', $status);
		$this->db->set('failed_text', $failed_text);
		$this->db->insert('order');
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

    public function check_order_key($order_key)
    {
        $this->db->select('*');
        $this->db->where('order_key',$order_key);
        $records = $this->db->get('order');
        return $records->row();
    }

	public function update_order($order_key, $failed_text,$status)
	{
		$data = array(
			'status'      => $status,
			'failed_text' => $failed_text
		);
		$this->db->where('order_key',$order_key);
		$records = $this->db->update('order',$data);
		return true;
	}

	public function order_mail_to_member($email,$content){
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
		$this->email->subject('Sipariş Bilgi');
		$this->email->message($content);
		$send = @$this->email->send();
		$this->email->clear(TRUE);
		return $send;
	}

	public function order_mail_to_admin($content){
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
		$this->email->to(settings("smtp_to"));
		$this->email->subject('Yeni Sipariş Bildirimi');
		$this->email->message($content);
		$this->email->attach('');
		$send = @$this->email->send();
		$this->email->clear();
		return $send;
		
	}

}