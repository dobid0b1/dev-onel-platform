<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Worksheet extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Worksheet_model');
		$this->load->model('Dashboard_model');
	}
	public function index(){
		if(!$this->session->userdata('staff_ses_name')){
            redirect(base_url('logout'));
		}
		$data['datalistTrack'] = $this->Dashboard_model->datalistTrack();
		$data['allStaff'] = $this->Dashboard_model->allStaff();

		$this->load->view('worksheet', $data); 
	}

	public function addWorksheet(){
		if(!$this->session->userdata('staff_ses_name')){
            redirect(base_url('logout'));
		}

		$data['allBrand'] = $this->Worksheet_model->allBrand();
		$data['allCust'] = $this->Worksheet_model->allCust();

		if($this->input->post('confirmBtn')){
			$addWSData['custID'] = $this->input->post('custID');
			$addWSData['serviceType'] = $this->input->post('serviceType');
			$addWSData['custType'] = $this->input->post('custType');
			$addWSData['subbrand'] = $this->input->post('subbrand');
			$addWSData['comment'] = $this->input->post('comment');

			if($this->input->post('brand') == 'other'){
				$addWSData['brand'] = $this->input->post('brandplus');
			}else{
				$addWSData['brand'] = $this->input->post('brand');
			}

			$path = $addWSData['custID'];
			// -IMG
				$date_str = date('Ymd');
				$time_str = date('His');
				$date_time = date('Y-m-d H:i:s');
				
				if (!is_dir("imgUpload/$path/")) {
					mkdir("imgUpload/$path/", 0777, TRUE);
				}
			
				$file_path = 'imgUpload/'.$path."/";
				
				$filename1 = $date_str."_".$time_str."_1";
				$file_upload1 = 'customerGoodsImage1';

				$filename2 = $date_str."_".$time_str."_11";
				$file_upload2 = 'customerGoodsImage2';

				$up1 = $this->set_upload_options($file_path, $filename1, $file_upload1);
				if($up1 == '1') {
					$data1 = array('image_metadata' => $this->upload->data());
					$file1 = $file_path.''.$data1['image_metadata']['file_name'];
				}
				
				$up2 = $this->set_upload_options($file_path, $filename2, $file_upload2);
				if($up2 == '1') {
					$data2 = array('image_metadata' => $this->upload->data());
					$file2 = $file_path.''.$data2['image_metadata']['file_name'];
				}

				$addWSData['today'] = $date_time;
				$addWSData['imgOne'] = $file1;
				$addWSData['imgTwo'] = $file2;
			// - - -

			// echo "<pre>";
			// print_r($addWSData);
			// exit();
			$addWSData['insertID'] = $this->Worksheet_model->addWorksheet($addWSData);
			$this->Worksheet_model->addHistory($addWSData);
			redirect('worksheet');
		}

		$this->load->view('addWorksheet', $data); 	
	}

	public function selectPhonebyID(){
		$custID = $_POST['custID'];
		$selectPhone = $this->Worksheet_model->selectPhone($custID);
		echo json_encode($selectPhone);
	}

	public function set_upload_options($file_path, $file_name, $file_upload){
        $config['upload_path']   = $file_path;
        $config['allowed_types'] = 'jpeg|jpg|png|gif';
        $config['max_size']      = 0;
        $config['max_width']     = 0;
        $config['file_name'] = $file_name; 

		$this->load->library('upload', $config);
		$imgUP = (!$this->upload->do_upload($file_upload))?'0':'1';
        return $imgUP;
    }

	public function addPointUser(){
		$wsID = $_POST['wsID'];
		$dataUser = $this->Worksheet_model->selectDataUser($wsID);

		if($dataUser->worksheet_credit >= 100){
			$userID = $dataUser->user_id;
			$oldPoint = $dataUser->user_point;

			$plusCredit = ($dataUser->worksheet_credit/100)+$oldPoint;

			$this->Worksheet_model->addPointUser($userID, $plusCredit);

		}
		$this->Worksheet_model->changeFlagPoint($wsID);

		echo json_encode($dataUser);
	}

}
?>