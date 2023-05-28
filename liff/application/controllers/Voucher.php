<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Voucher extends CI_Controller {
    
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Voucher_modal');
	}

	public function index(){
	    $data['allVoucher'] = $this->Voucher_modal->allVoucher();
		$this->load->view('voucher', $data);
	}

	public function detailVoucher(){
		$vID = $_POST['vID'];
		$detailV = $this->Voucher_modal->detailVoucher($vID);
		echo json_encode($detailV);
	}

	public function detailMember(){
		$uID = $_POST['userID'];
		$detailMember = $this->Voucher_modal->detailMember($uID);
		echo json_encode($detailMember);
	}

	public function confirmVoucher(){
		$uID = $_POST['userID'];
		$vID = $_POST['vID'];
		$usePoint = $_POST['usePoint'];
		$uPoint = $_POST['uPoint'];
		$currentPoint = $uPoint - $usePoint;

		$this->Voucher_modal->editPoint($uID, $currentPoint);

		$this->Voucher_modal->insertVLog($uID, $vID, $usePoint, $currentPoint);

		echo json_encode('success');
	}
 
} 