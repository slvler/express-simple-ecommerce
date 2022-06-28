<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		// Yönetim paneli kullanıcı girişi kontrolü
		if (! isset($this->session->userdata['logged_in'])) { redirect('/admin/login', 'refresh'); }
		
		$this->load->model('basket/Admin_model');
	}
	
	public function index()
	{
		$this->load->library('migration');
		if ($this->migration->init_module("basket")) { $this->migration->current(); }
		$this->data['status_type'] = 1;
		$filters = (array) @$this->input->get();
		$filters['status_type'] = $this->data['status_type'];
		if (@$this->session->userdata("logged_in")["type"]=="region") {
			$this->data['order'] = $this->Admin_model->order_region($filters);
		}else{
			$this->data['order'] = $this->Admin_model->order($filters);
		}
		$this->load->view('basket/admin/admin', $this->data);
	}
	
	public function failed_order()
	{
		$this->data['status_type'] = 2;
		$filters = (array) @$this->input->get();
		$filters['status_type'] = $this->data['status_type'];
		$this->data['order'] = $this->Admin_model->order($filters);
		$this->load->view('basket/admin/admin', $this->data);
	}
	
	public function detail()
	{
		$id = (int)($this->uri->segment(4));
		
		if($this->input->post("status")){
			$this->Admin_model->change_status($id, $this->input->post());
			$this->session->set_flashdata("success_message", "Sipariş durumu değiştirildi.");
			redirect('basket/admin/detail/'.$id, 'refresh');
		}else{
			$this->data['detail'] = $this->Admin_model->detail($id);
			$this->load->view('basket/admin/detail', $this->data);
		}
	}
	// public function generate_excel() {
	// 	$this->load->library('excel');
	// 	$this->excel->setActiveSheetIndex(0);
	// 	$sheet = $this->excel->getActiveSheet();
	// 	$sheet->setTitle('Sipariş Listesi');
	// 	$filters = (array) @$this->input->get();
	// 	$filters['export_data'] = array('order_key','name','surname','invoice_type','cargo_price','total','installment','payment_status','status','failed_text','date','products');
	// 	$orders = $this->Admin_model->order($filters,1400);
	// 	$sheet->setCellValue('A1', 'Sipariş Numarası');
	// 	$sheet->setCellValue('B1', 'Ad');
	// 	$sheet->setCellValue('C1', 'Soyad');
	// 	$sheet->setCellValue('D1', 'Fatura Tipi');
	// 	$sheet->setCellValue('E1', 'Kargo Ücreti');
	// 	$sheet->setCellValue('F1', 'Sipariş Tutarı');
	// 	$sheet->setCellValue('G1', 'Toplam Tutar');
	// 	$sheet->setCellValue('H1', 'Taksit Sayısı');
	// 	$sheet->setCellValue('I1', 'Ödeme Durumu');
	// 	$sheet->setCellValue('J1', 'Durum');
	// 	$sheet->setCellValue('K1', 'Hata Mesajı');
	// 	$sheet->setCellValue('L1', 'Tarih');
	// 	$rows = 2;
	// 	foreach ($orders as $order) {
	// 		$order_total = 0; foreach(json_decode($order["products"], true) as $product) {
	// 			$order_total += $product["subtotal"];
	// 		}
	// 		$sheet->setCellValue('A'.$rows, $order['order_key']);
	// 		$sheet->setCellValue('B'.$rows, $order['name']);
	// 		$sheet->setCellValue('C'.$rows, $order['surname']);
	// 		$sheet->setCellValue('D'.$rows, $order['invoice_type']);
	// 		$sheet->setCellValue('E'.$rows, $order['cargo_price']);
	// 		$sheet->setCellValue('F'.$rows, $order_total);
	// 		$sheet->setCellValue('G'.$rows, $order['total']);
	// 		$sheet->setCellValue('H'.$rows, $order['installment']);
	// 		$sheet->setCellValue('I'.$rows, $order['payment_status']);
	// 		$sheet->setCellValue('J'.$rows, $order['status']);
	// 		$sheet->setCellValue('K'.$rows, ($order['status'] == 'Onaylanmamış') ? $order['failed_text'] : '');
	// 		$sheet->setCellValue('L'.$rows, $order['date']);
	// 		$rows++;
	// 	}
	// 	$filename='sanalmagaza.xls';
	// 	header('Content-Type: application/vnd.ms-excel'); //mime type
	// 	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	// 	header('Cache-Control: max-age=0'); //no cache
	// 	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	// 	$objWriter->save('php://output');
	// }
	
	// public function delete_record()
	// {
		// $id = (int)($this->uri->segment(4));

		// $delete = $this->Admin_model->post_delete_record($id);
		// if($delete){
			// $this->session->set_flashdata("success_message", "Silme işlemi başarılı!");
		// }
		// redirect('/contact/admin', 'refresh');
	// }
}
