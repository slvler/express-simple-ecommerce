<?php
class Admin_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function order($filters, $limit = 0)
	{
		if ($limit > 0){ $this->db->limit($limit); }
		if(@$filters["export_data"]) {
			$export_data = implode(',',$filters["export_data"]);
			$this->db->select($export_data);
		} else {
			$this->db->select('*');
		}
		
		// filtreler
		if(@$filters["status"]){
			$this->db->where("status", $filters["status"]);
		}
		if(@$filters["status_type"]) {
			if($filters["status_type"] == 1)
				$this->db->where("status !=", "Onaylanmamış");
			else
				$this->db->where("status", "Onaylanmamış");
		}
		if(@$filters["payment"]){
			$this->db->like("payment_status", $filters["payment"], "after");
		}
		if(@$filters["regions"]){
			$this->db->where("region_id", $filters["regions"]);
		}
		if(@$filters["order_key"]){
			$this->db->like("order_key", trim($filters["order_key"]), "after");
		}
		if(@$filters["email"]){
			$this->db->join('member', 'member.id = order.member_id');
			$this->db->like("member.email", trim($filters["email"]), "after");
		}
		$this->db->order_by('date desc');
		$records = $this->db->get('order');
		return $records->result_array();
	}

	public function order_region($filters, $limit = 0)
	{
		if ($limit > 0){ $this->db->limit($limit); }
		if(@$filters["export_data"]) {
			$export_data = implode(',',$filters["export_data"]);
			$this->db->select($export_data);
		} else {
			$this->db->select('*');
		}
		
		// filtreler
		if(@$filters["status"]){
			$this->db->where("status", $filters["status"]);
		}
		if(@$filters["status_type"]) {
			if($filters["status_type"] == 1)
				$this->db->where("status !=", "Onaylanmamış");
			else
				$this->db->where("status", "Onaylanmamış");
		}
		if(@$filters["payment"]){
			$this->db->like("payment_status", $filters["payment"], "after");
		}
		if(@$filters["price_condition"] && @$filters["price"]){
			$this->db->where("total ".$filters["price_condition"], $filters["price"]);
		}
		if(@$filters["start_date"]){			
			$this->db->where("date >=", date("Y-m-d",strtotime(str_replace("/","-",$filters["start_date"])))." 00:00:00");
		}
		if(@$filters["end_date"]){			
			$this->db->where("date <=", date("Y-m-d",strtotime(str_replace("/","-",$filters["end_date"])))." 23:59:59");
		}
		$this->db->where("region_id", $this->session->userdata("logged_in")["id"]);
		$this->db->order_by('date desc');
		$records = $this->db->get('order');
		return $records->result_array();
	}
	public function failed_order()
	{
		$this->db->select('*');
		$this->db->where("status", "Onaylanmamış");
		$this->db->order_by('date desc');
		$records = $this->db->get('order');
		return $records->result_array();
	}
	
	public function detail($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$records = $this->db->get('order');
		return $records->row_array();
	}
	
	public function change_status($id, $post)
	{
		$data = array(
			'status'				=> $post["status"],
			'status_cancellation'	=> @$post["cancellation"]
		);
		$this->db->where('id',$id);
		$this->db->update('order',$data);
		
		if($post["status"] == "İptal Edildi"){
			$this->info_mail_for_member($post, $post["status"]);
		}
		
		return true;
	}
	
	public function info_mail_for_member($post, $status)
	{
		$mail_title = "Sipariş İptal Edildi Bilgisi";
		$eb = '<style>html,body {margin: 0 auto !important;padding: 0 !important;height: 100% !important;width: 100% !important;line-height:1;border:0 !important;background-color:#ffffff;color:#231f20;font-family:"Poppins",Verdana,Arial,sans-serif;font-size:14px;line-height:22px;}
            * {-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;}
		table,td {mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border: 0;}
		th, td {color:#231f20;padding:5px 10px;text-align:left;font-size: 14px;}
		th {font-weight: bold;}
		table {border-spacing: 0 !important;border-collapse: collapse !important;margin: 0 !important;}
		table table {table-layout: auto;}
		img,a img{border:0; outline:none; text-decoration:none;}
		h1,h2,h3,h4,h5,h6{margin:0; padding:0;}
		p{margin:1em 0; padding:0;}
		a{word-wrap:break-word;}
		img{-ms-interpolation-mode:bicubic;}
		body,table,td,p,a,li,blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}
		.bodyTable, .bodyCell { height: 100% !important;margin: 0;padding: 0;width: 100% !important;}
		.tableHead {border: 2px solid #ffffff;}
		.tableHead thead td, .tableHead thead th {color:#624FAE;background-color:#ffffff;}
		.tableHead tbody th, .tableHead tbody td {border:1px solid #624FAE;}
		.tableRed {border: 2px solid #624FAE;}
		.tableRed thead td, .tableRed thead th {color:#ffffff;background-color:#624FAE;}
		.tableRed tbody th, .tableRed tbody td {border:1px solid #624FAE;}
		.message-body {font-family:"Poppins",Verdana,Arial,sans-serif;font-size:14px;line-height:22px;}</style>';
		$eb .= '
		<table width="100%" cellpadding="0" align="center" style="width:100%;">
		<tbody>
		<tr>
		<td align="center" valign="top" style="text-align:center;">
		<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" style="width:600px;text-align:center;margin:0 auto !important;">
		<tbody>'; 
		/* Üst Açıklama */                         
		$eb .= '
		<tr>
		<td align="center" style="text-align:center;">
		<a href="'.site_url().'" target="_blank" rel="noreferrer nofollow noopener">
		<img referrerpolicy="no-referrer" src="'.site_url(image_moo(settings("logo"),"","","#fff")).'" style="height:90px;padding:0;margin:0;border:0;display:block;vertical-align:top;" /></a></td></tr>'; 
		$eb .= '<tr><td align="center" style="line-height:40px;font-weight: bold;font-size:24px;text-align:center;color:#624FAE;">
		<strong>Sayın yetkili,</strong></td></tr>';

		$eb .= '<tr><td style="line-height:20px;font-size:16px;padding:10px 10px 15px 10px;" align="center">'.$post["order_key"].' numaralı sipariş iptal edilmiştir. Yönetim paneli üzerinden açıklaması ile birlikte görüntüleyebilirsiniz.<br><br>İptal Sebebi: '.$post["cancellation"].'</td></tr>';

		/* Üst Açıklama Bitiş */ 

		/* Footer Logo ve adres Bilgileri */
		$eb .= '
		<tr>
		<td style="background-color: #624FAE;">
		<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" style="width:600px;text-align:center;margin:0 auto !important;">
		<tbody>
		<tr>
		<td align="center" style="text-align:left;">
		<a href="'.site_url().'" target="_blank" rel="noreferrer nofollow noopener">
		<img referrerpolicy="no-referrer" src="'.site_url(image_moo(settings("logo2"))).'" alt="'.settings("title").'" style="display:inline-block;" />
		</a>
		</td>
		<td style="text-align:right;color:#ffffff; line-height: 1.4;">
		<p><strong>'.settings("title").'</strong></p>
		<p>
		<strong>Müşteri Hizmetleri: <a href="tel:4441110" style="color:#ffffff;text-decoration: none;">444 11 10</a><br />
		<strong>E-mail:</strong> <a href="mailto:iletisim@ozsut.com.tr" style="color:#ffffff;text-decoration: none;">iletisim@ozsut.com.tr</a>
		</p>
		</td>
		</tr>
		</tbody>
		</table>    
		</td>
		</tr>';

		/* Footer Logo ve adres Bilgileri Bitiş */
		$eb .= '
		</tbody>
		</table>
		</div>
		</body>
		</html>';

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
		$this->email->subject($mail_title);
		$this->email->message($eb);
		$send = @$this->email->send();
		$this->email->clear();

		return $send;
	}
}
