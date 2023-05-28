<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Member extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Member_model');
	}
	public function index(){
		$data['provinceData'] = $this->Member_model->selectProvince();

		if($this->input->post('submitBtn')){
			$insertData['lineID'] = $this->input->post('lineID');
			$insertData['memberName'] = $this->input->post('memberName');
			$insertData['memberPhone'] = $this->input->post('memberPhone');
			$insertData['memberAddress'] = $this->input->post('memberAddress');
			$insertData['nameProvince'] = $this->input->post('nameProvince');
			$insertData['nameAmphoe'] = $this->input->post('nameAmphoe');
			$insertData['nameDistrict'] = $this->input->post('nameDistrict');
			$insertData['zipcode'] = $this->input->post('zipcode');

			if($this->Member_model->checkMemberbyPhone($insertData)){ 
				$this->Member_model->updateDataInformation($insertData);
				redirect('liff/member');
				// echo "1";
				// exit();
			}
			else{
				$this->Member_model->insertDataInformation($insertData);
				redirect('liff/member');
			}
		}

		$this->load->view('member', $data); 
	}

	public function selectAmphoe(){
		$province = $_POST['province'];
		$selectAmphoe = $this->Member_model->selectAmphoe($province);
		echo json_encode($selectAmphoe);
	}

	public function selectDistrict(){
		$amphoe = $_POST['amphoe'];
		$selectAmphoe = $this->Member_model->selectDistrict($amphoe);
		echo json_encode($selectAmphoe);
	}
	
	public function selectZipcode(){
		$district = $_POST['district'];
		$selectZipcode = $this->Member_model->selectZipcode($district);
		echo json_encode($selectZipcode);
	}

	public function checkDataMember(){
		$lineID = $_POST['lineID'];
		$insertData['lineID'] = $lineID;
		$checkDataMember = $this->Member_model->checkMember($insertData);
		echo json_encode($checkDataMember);
	}

	public function editMember(){
		$data['provinceData'] = $this->Member_model->selectProvince();

		if($this->input->post('submitBtn')){
			$insertData['lineID'] = $this->input->post('lineID');
			$insertData['memberName'] = $this->input->post('memberName');
			$insertData['memberPhone'] = $this->input->post('memberPhone');
			$insertData['memberAddress'] = $this->input->post('memberAddress');
			$insertData['nameProvince'] = $this->input->post('nameProvince');
			$insertData['nameAmphoe'] = $this->input->post('nameAmphoe');
			$insertData['nameDistrict'] = $this->input->post('nameDistrict');
			$insertData['zipcode'] = $this->input->post('zipcode');

			if($this->Member_model->checkMember($insertData)){
				$this->Member_model->updateDataInformation($insertData);
				redirect('liff/member');
			}
			else{
				$this->Member_model->insertDataInformation($insertData);
				redirect('liff/service');
			}
		}

		$this->load->view('editMember', $data); 
	}
} 
