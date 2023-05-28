<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class History extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('History_model');
		$this->load->model('Member_model');
	}
	public function index(){
		$this->load->view('history');
	}

	public function allHistory(){
		$lineID = $_POST['lineID'];
		$insertData['lineID'] = $lineID;
		$checkDataMember = $this->Member_model->checkMember($insertData);
		$userID = $checkDataMember[0]['user_id'];

		$allHistoryByUserID = $this->History_model->allHistoryByUserID($userID);
		echo json_encode($allHistoryByUserID);
	}

	public function getDataWorksheet(){
		$wsID = $_POST['wsID'];
		$getDataWorksheet = $this->History_model->getDataWorksheet($wsID);
		echo json_encode($getDataWorksheet);
	}
} 
