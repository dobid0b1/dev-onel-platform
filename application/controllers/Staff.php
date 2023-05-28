<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Staff extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Staff_model');
        $this->load->library('session');
	}

    public function index(){
		if(!$this->session->userdata('staff_ses_name')){
            redirect(base_url('logout'));
		}
        
        $data['datalistPosotion'] = $this->Staff_model->datalistPosotion();
        $data['datalistPosotion'] = $this->Staff_model->datalistPosotion();

        if($this->input->post('updateBtn')){
            $updateStaffData['updateUser'] = $this->input->post('updateUser');
            $updateStaffData['updatePass'] = $this->input->post('updatePass');
            $updateStaffData['updateName'] = $this->input->post('updateName');
            $updateStaffData['updatePosition'] = $this->input->post('updatePosition');
            $updateStaffData['updateLevel'] = $this->input->post('updateLevel');
            $updateStaffData['staffID'] = $this->input->post('staffID');

            $this->Staff_model->updateStaff($updateStaffData);
            redirect('staff');
        }

        if($this->input->post('confirmBtn')){
            $addStaffData['addUserName'] = $this->input->post('addUserName');
            $addStaffData['addPassword'] = $this->input->post('addPassword');
            $addStaffData['addName'] = $this->input->post('addName');
            $addStaffData['addPosition'] = $this->input->post('addPosition');
            $addStaffData['addLevel'] = $this->input->post('addLevel');

            $this->Staff_model->addStaff($addStaffData);
            redirect('staff');
        }

        $this->load->view('staff', $data);
    }

    public function allStaff(){
        $allStaff = $this->Staff_model->allStaff();
        $test = '{"data": [';
        foreach($allStaff as $aCust){
            $test .= '[';
            $test .= '"<center>'.$aCust['staff_id'].'</center>",';

            $test .= '"'.$aCust['staff_name'];
            if($aCust['staff_flag'] == '0'){
                $test .= ' <i class=\'text-danger\'>(บัญชีถูกระงับ)</i>';
            }
            $test .= '<br>';
            $test .= '<span class=\'text-secendary\' style=\'font-size: .7rem;\'>username: '.$aCust['staff_username'].'</span><br>';
            $test .= '<span class=\'text-secendary\' style=\'font-size: .7rem;\'>password: '.$aCust['staff_password'].'</span>",';

            $test .= '"<center>'.$aCust['staff_position'].'</center>",';

            $test .= '"<center>';

            if($aCust['staff_level'] == 'admin'){
                $test .= 'ผู้ดูแลระบบ';
            }else if($aCust['staff_level'] == 'manager'){
                $test .= 'ผู้จัดการ';
            }else if($aCust['staff_level'] == 'staff'){
                $test .= 'พนักงาน';
            }else{
                $test .= '-';
            }
            $test .= '</center>",';

            $test .= '"<button class=\'btn btn-primary mr-2\' onclick=\'infoStaff('.$aCust['staff_id'];
            $test .= ')\' title=\'ดูข้อมูล\'><i class=\'fas fa-info-circle\'></i>&nbsp;ข้อมูลพนักงาน</button>"';
            $test .= '],';
        }
        $test .= ']}';		
        echo str_replace("],]}", "]]}", $test);
    }

    public function infoStaff(){
        $staffID = $_POST['staffID'];
        $infoStaff = $this->Staff_model->infoStaff($staffID);
        echo json_encode($infoStaff);
    }

    public function changeFlag(){
        $staffID = $_POST['staffID'];
        $flag = $_POST['flag'];
        $this->Staff_model->changeFlag($staffID, $flag);
    }
}
?>