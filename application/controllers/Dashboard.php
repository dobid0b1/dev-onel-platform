<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Dashboard_model');
	}
	public function index() {
		if(!$this->session->userdata('staff_ses_name')){
            redirect(base_url('logout'));
		}

		$data['countWorksheet'] = $this->Dashboard_model->countWorksheet();
		$data['datalistTrack'] = $this->Dashboard_model->datalistTrack();
		$data['countWSStaff'] = $this->Dashboard_model->countWSStaff();
		$data['allStaff'] = $this->Dashboard_model->allStaff();
		$data['top5'] = $this->Dashboard_model->top5();


		$this->load->view('dashboard', $data); 
	}

	public function getDetailWorksheet(){
		$wsID = $_POST['wsID'];
        $getDetailWorksheet = $this->Dashboard_model->getDetailWorksheet($wsID);
		echo json_encode($getDetailWorksheet);
	}

	public function showAllWorksheet(){
        $allWorksheetInProcess = $this->Dashboard_model->allWorksheetInProcess();
		
		$test = '{"data": [';

		foreach($allWorksheetInProcess as $aWiP){

			$test .= '[';
			
			$test .= '"<center>'.$aWiP['worksheet_id'].'</center>",';

			$test .= '"<div class=\'widget-content p-0\'><div class=\'widget-content-wrapper\'>';
			$test .= '<div class=\'widget-content-left mr-3\'><div class=\'widget-content-left\'>';
			if($aWiP['worksheet_type'] == 'bag'){
				$test .= '<img width=\'40\' class=\'rounded-circle\' src=\''.base_url().'images/bag.png\' alt=\'\'>';
			}
			else if($aWiP['worksheet_type'] == 'shoe'){
				$test .= '<img width=\'40\' class=\'rounded-circle\' src=\''.base_url().'images/shoe.png\' alt=\'\'>';
			}
			else{
				$test .= '<img width=\'40\' class=\'rounded-circle\' src=\''.base_url().'images/other.png\' alt=\'\'>';
			}
			$test .= '</div></div><div class=\'widget-content-left flex2\'>';
			$test .= '<div class=\'widget-heading\'>';

			if($aWiP['worksheet_get_money'] != '0000-00-00 00:00:00' &&
				$aWiP['worksheet_get_money'] != ''){
				$test .= '<img src=\''.base_url().'images/checked.png\' width=\'13px\'> ';
			}

			$test.= $aWiP['worksheet_brand'].' | '.$aWiP['worksheet_subbrand'].'</div>';
			$test .= '<div class=\'widget-subheading opacity-7 text-secondary\' style=\'font-size: .7rem\'>'.$aWiP['user_name'].'</div>';
			$test .= '</div></div></div>",';

			$test .= '"<center>'.$aWiP['worksheet_receive_date'].'</center>",';
			
			if($aWiP['worksheet_status'] == 'รอส่งร้าน'){
				$test .= '"<center><div class=\'badge badge-warning\'>รอลูกค้าส่งสินค้า</div><center>",';
			}else if($aWiP['worksheet_status'] == 'ร้านรับแล้ว'){
				$test .= '"<center><div class=\'badge badge-danger\'>กำลังดำเนินการ</div><br>';
				$test .= '<div class=\'badge badge-info\'>'.$aWiP['worksheet_track'].'</div><center>",';
			}else{
				$test .= '"-",';
			}
					
			$test .= '"<center><button type=\'button\' id=\'PopoverCustomT-1\' onclick=\'showDetailWS('.$aWiP['worksheet_id'].')\'';
			$test .= 'class=\'btn btn-primary btn-sm\'><i class=\'fas fa-clipboard\'></i>&nbsp; รายละเอียดใบงาน</button><center>"';

			$test .= '],';
		}

		$test .= ']}';		
		echo str_replace("],]}", "]]}", $test);
	}

	public function showSuccessWorksheet(){
        $showSuccessWorksheet = $this->Dashboard_model->showSuccessWorksheet();
		
		$test = '{"data": [';

		foreach($showSuccessWorksheet as $sSW){

			$test .= '[';
			
			$test .= '"'.$sSW['worksheet_id'].'",';

			$test .= '"<div class=\'widget-content p-0\'><div class=\'widget-content-wrapper\'>';
			$test .= '<div class=\'widget-content-left mr-3\'><div class=\'widget-content-left\'>';
			if($sSW['worksheet_type'] == 'bag'){
				$test .= '<img width=\'40\' class=\'rounded-circle\' src=\''.base_url().'images/bag.png\' alt=\'\'>';
			}
			else if($sSW['worksheet_type'] == 'shoe'){
				$test .= '<img width=\'40\' class=\'rounded-circle\' src=\''.base_url().'images/shoe.png\' alt=\'\'>';
			}
			else{
				$test .= '<img width=\'40\' class=\'rounded-circle\' src=\''.base_url().'images/other.png\' alt=\'\'>';
			}
			$test .= '</div></div><div class=\'widget-content-left flex2\'>';
			$test .= '<div class=\'widget-heading\'>';
			if($sSW['worksheet_get_money'] != '0000-00-00 00:00:00' &&
				$sSW['worksheet_get_money'] != ''){
				$test .= '<img src=\''.base_url().'images/checked.png\' width=\'13px\'> ';
			}
			$test .= $sSW['worksheet_brand'].' | '.$sSW['worksheet_subbrand'].'</div>';
			$test .= '<div class=\'widget-subheading opacity-7\'>'.$sSW['user_name'].'</div>';
			$test .= '</div></div></div>",';

			$test .= '"'.$sSW['worksheet_end_date'].'",';
			
			$test .= '"<div class=\'badge badge-success\'>ส่งคืนลูกค้าแล้ว</div><br>';
			$test .= '<div class=\'badge badge-secondary\'>'.$sSW['worksheet_provider_logis'].'</div>&nbsp;';
			$test .= '<div class=\'badge badge-info\'>'.$sSW['worksheet_tag_logis'].'</div>",';
					
			$test .= '"<button type=\'button\' id=\'PopoverCustomT-1\' onclick=\'showDetailWS('.$sSW['worksheet_id'].')\'';
			$test .= 'class=\'btn btn-primary btn-sm\'>ดูใบงาน</button>&nbsp;';

			if($sSW['worksheet_point_flag'] == 0){
				$test .= '<button type=\'button\' id=\'PopoverCustomT-1\' onclick=\'addPoint('.$sSW['worksheet_id'].')\'';
				$test .= 'class=\'btn btn-warning btn-sm\'>เพิ่มคะแนน</button>';
			}

			$test .= '"';

			$test .= '],';
		}

		$test .= ']}';		
		echo str_replace("],]}", "]]}", $test);
	}

	public function showNomoneyWorksheet(){
        $showNomoneyWorksheet = $this->Dashboard_model->showNomoneyWorksheet();
		
		$test = '{"data": [';

		foreach($showNomoneyWorksheet as $sNW){

			$test .= '[';
			
			$test .= '"'.$sNW['worksheet_id'].'",';

			$test .= '"<div class=\'widget-content p-0\'><div class=\'widget-content-wrapper\'>';
			$test .= '<div class=\'widget-content-left mr-3\'><div class=\'widget-content-left\'>';
			if($sNW['worksheet_type'] == 'bag'){
				$test .= '<img width=\'40\' class=\'rounded-circle\' src=\''.base_url().'images/bag.png\' alt=\'\'>';
			}
			else if($sNW['worksheet_type'] == 'shoe'){
				$test .= '<img width=\'40\' class=\'rounded-circle\' src=\''.base_url().'images/shoe.png\' alt=\'\'>';
			}
			else{
				$test .= '<img width=\'40\' class=\'rounded-circle\' src=\''.base_url().'images/other.png\' alt=\'\'>';
			}
			$test .= '</div></div><div class=\'widget-content-left flex2\'>';
			$test .= '<div class=\'widget-heading\'>';
			if($sNW['worksheet_get_money'] != '0000-00-00 00:00:00' &&
				$sNW['worksheet_get_money'] != ''){
				$test .= '<img src=\''.base_url().'images/checked.png\' width=\'13px\'> ';
			}
			$test .= $sNW['worksheet_brand'].' | '.$sNW['worksheet_subbrand'].'</div>';
			$test .= '<div class=\'widget-subheading opacity-7\'>'.$sNW['user_name'].'</div>';
			$test .= '</div></div></div>",';

			$test .= '"'.$sNW['worksheet_end_date'].'",';
			
			$test .= '"<div class=\'badge badge-success\'>ส่งคืนลูกค้าแล้ว</div><br>';
			$test .= '<div class=\'badge badge-secondary\'>'.$sNW['worksheet_provider_logis'].'</div>&nbsp;';
			$test .= '<div class=\'badge badge-info\'>'.$sNW['worksheet_tag_logis'].'</div>",';
					
			$test .= '"<button type=\'button\' id=\'PopoverCustomT-1\' onclick=\'showDetailWS('.$sNW['worksheet_id'].')\'';
			$test .= 'class=\'btn btn-primary btn-sm\'><i class=\'fas fa-clipboard\'></i>&nbsp; รายละเอียดใบงาน</button>"';

			$test .= '],';
		}

		$test .= ']}';		
		echo str_replace("],]}", "]]}", $test);
	}

	public function updateWorksheetData(){
		$wsData['wsID'] = $_POST['wsID'];
        $wsData['wsTrack'] = $_POST['wsTrack'];
        $wsData['wsRD'] = $_POST['wsRD'];
        $wsData['wsED'] = $_POST['wsED'];
        $wsData['wsStaff'] = $_POST['wsStaff'];
        $wsData['wsPrice'] = $_POST['wsPrice'];
        $wsData['providerLogis'] = $_POST['providerLogis'];
        $wsData['tagLogis'] = $_POST['tagLogis'];
        $wsData['comment'] = $_POST['comment'];
        $wsData['dateMoney'] = $_POST['dateMoney'];

        $this->Dashboard_model->updateWorksheetData($wsData);
		echo json_encode($wsData);
	}
}
?>