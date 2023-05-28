<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tracking extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Track_modal');
		$this->load->model('Member_model');
	}
	public function index(){
		$this->load->view('track');
	}
 
	public function allTracking(){
		$lineID = $_POST['lineID'];
		$insertData['lineID'] = $lineID;
		$checkDataMember = $this->Member_model->checkMember($insertData);
		$userID = $checkDataMember[0]['user_id'];

		$allTrackByUserID = $this->Track_modal->allTrackByUserID($userID);
		// $allTrackByLineID = $this->Track_modal->allTrackByLineID($lineID);
		echo json_encode($allTrackByUserID);
	}
} 
