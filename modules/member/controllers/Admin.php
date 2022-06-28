<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		// Yönetim paneli kullanıcı girişi kontrolü
		if (! isset($this->session->userdata['logged_in'])) { redirect('/admin/login', 'refresh'); }
		
		$this->load->model('member/Admin_model');
		$this->load->helper('img_upload');
	}
	
	public function index()
	{
		$this->load->library('migration');
		if ($this->migration->init_module("member")) { $this->migration->current(); }
		
		$this->load->library('pagination');
		$pagination['page_query_string']	= TRUE;
		$pagination['base_url']				= "member/admin/index";
		$pagination['total_rows']			= $this->Admin_model->recCount();
		$pagination['per_page']				= 25;
		$pagination['full_tag_open']		= '<div class="btn-group pull-right mt-15">';
		$pagination['full_tag_close']		= '</div>';
		$pagination['first_link']			= 'İlk';
		$pagination['cur_tag_open']			= '<a class="btn btn-xs btn-success">';
		$pagination['cur_tag_close']		= '</a>';
		$pagination['last_link']			= 'Son';
		$pagination['attributes']			= array('class' => 'btn btn-xs btn-success btn-outline');
		$this->pagination->initialize($pagination);
		
		if(@$_GET["s"] || @$_GET["s_type"] || @$_GET["s_city"]){
			$this->data['page'] = (array) $this->Admin_model->search(trim($_GET["s"]));
		}else{
			$this->data['page'] = (array) $this->Admin_model->page($pagination["per_page"], intval(@$_GET["per_page"]));
		}

		$this->data['total_count'] = $this->Admin_model->recCount();
		$this->load->view('member/admin/admin', $this->data);
	}
	
	public function change_active()
	{
		$id = (int)($this->uri->segment(4));
		$active = (int)($this->uri->segment(5));
		$this->Admin_model->change_active($id, $active);
		
		// Üyeye onay verildiğine dair bilgi maili gidiyor
		if($active == 0){
			$member = $this->Admin_model->record($id);
			
			$mail_text = "<img src='".site_url(image_moo(settings("logo"),300))."' />";
			$mail_text .= "<br><br>";
			$mail_text .= "Sayın ".$member->name." ".$member->surname.",";
			$mail_text .= "<br>";
			$mail_text .= "E.C.A. Teknik Ürünler web sayfası üyeliğiniz onaylanmıştır.";
			$mail_text .= "<br>";
			$mail_text .= "<a href='".site_url("member/login")."'>Üye Girişi</a> sayfasından giriş yapabilirsiniz.";
			$mail_text .= "<br>";
			$mail_text .= "İyi çalışmalar dileriz.";
			
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
			$this->email->to($member->email);
			$this->email->subject("E.C.A. Teknik Ürünler");
			$this->email->message($mail_text);
			$result = $this->email->send();
		}
		
		$this->session->set_flashdata("success_message", "Aktiflik durumu değiştirildi!");
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function edit_record()
	{
		$id = (int)($this->uri->segment(4));
		
		if($_POST){
			$this->Admin_model->edit_record($id, $this->input->post());
			$this->session->set_flashdata("success_message", "Düzenleme başarılı!");
			redirect('member/admin/edit_record/'.$id, 'refresh');
		}else{
			$this->data['page'] = (array) $this->Admin_model->record($id);
			$this->load->view('member/admin/edit_record', $this->data);
		}
	}

	public function delete_record()
	{
		$id = (int)($this->uri->segment(4));
		
		$this->Admin_model->delete_record($id);
		$this->session->set_flashdata("success_message", "Silme işlemi başarılı!");
		redirect('/member/admin/index', 'refresh');
	}
	
	public function excel_export()
	{
		if(! file_exists("_cache")){ mkdir("_cache", 0777); }
		if(! file_exists("_cache/excel_export")){ mkdir("_cache/excel_export", 0777); }
		$this->load->library('Excel');
		$excel_export = new PHPExcel();
		
		$excel_export->getActiveSheet()->setTitle(date("d-m-Y"));
		
		$excel_export->getActiveSheet()->setCellValue('A1', 'Ad');
		$excel_export->getActiveSheet()->setCellValue('B1', 'Soyad');
		$excel_export->getActiveSheet()->setCellValue('C1', 'E-Posta');
		$excel_export->getActiveSheet()->setCellValue('D1', 'Telefon');
		$excel_export->getActiveSheet()->setCellValue('E1', 'Şehir');
		$excel_export->getActiveSheet()->setCellValue('F1', 'İlçe');
		$excel_export->getActiveSheet()->setCellValue('G1', 'Adres');
		$excel_export->getActiveSheet()->setCellValue('H1', 'Üyelik Tarihi');
		$excel_export->getActiveSheet()->setCellValue('I1', 'Üyelik Durumu');
		
		$row = 2;
		foreach($this->Admin_model->page() as $member){
			$active = ($member->active == 1 ? "Aktif" : "Pasif");
			
			$excel_export->getActiveSheet()->setCellValue("A".$row, $member->name);
			$excel_export->getActiveSheet()->setCellValue("B".$row, $member->surname);
			$excel_export->getActiveSheet()->setCellValue("C".$row, $member->email);
			$excel_export->getActiveSheet()->setCellValue("D".$row, $member->phone);
			$excel_export->getActiveSheet()->setCellValue("E".$row, get_city_title($member->city));
			$excel_export->getActiveSheet()->setCellValue("F".$row, get_town_title($member->town));
			$excel_export->getActiveSheet()->setCellValue("G".$row, $member->address);
			$excel_export->getActiveSheet()->setCellValue("H".$row, $member->created_date);
			$excel_export->getActiveSheet()->setCellValue("I".$row, $active);
			$row++;
		}
		
		$dateid = date('YmdHis');
		$save = PHPExcel_IOFactory::createWriter($excel_export, 'Excel5');
		$save->save("_cache/excel_export/uyeler-".$dateid.".xls");
		$this->load->helper('download');
		force_download("_cache/excel_export/uyeler-".$dateid.".xls", NULL);
		redirect($_SERVER['HTTP_REFERER']);
	}
}