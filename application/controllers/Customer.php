<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Customer_model');
        $this->load->library('session');
	}

	public function index(){
		if(!$this->session->userdata('staff_ses_name')){
            redirect(base_url('logout'));
		}

        $data['provinceData'] = $this->Customer_model->selectProvince();

        if($this->input->post('confirmBtn')){
            $addData['addName'] = $this->input->post('addName');
            $addData['addPhone'] = $this->input->post('addPhone');
            $addData['addAddress'] = $this->input->post('addAddress');
            $addData['addProvince'] = $this->input->post('addProvince');
            $addData['addAmphoe'] = $this->input->post('addAmphoe');
            $addData['addDistrict'] = $this->input->post('addDistrict');
            $addData['addZipcode'] = $this->input->post('addZipcode');
            
            $checkCust = $this->Customer_model->checkCust($addData);
            if($checkCust){
                $this->session->set_flashdata('haveCust', '1');
                $this->session->set_flashdata('hcTxt', 'มีสมาชิกในระบบแล้ว');
                redirect('customer');
            }
            else{
                $this->Customer_model->addCustbyStaff($addData);
                redirect('customer');
            }
        }

        $this->load->view('customer', $data);      
	}

    public function allCustomers(){
        $allCust = $this->Customer_model->allCust();
        $test = '{"data": [';
        foreach($allCust as $aCust){
            $test .= '[';
            $test .= '"<center>'.$aCust['user_id'].'</center>",';
            $test .= '"';
            if($aCust['user_line_id']){
                $test .= '<img src=\''.base_url().'images/checked.png\' width=\'12px\'>&nbsp;';
            }
            $test .= $aCust['user_name'].'<br>';
            $test .= '<span class=\'text-secendary\' style=\'font-size: .7rem;\'>#Tel: '.$aCust['user_phone'].'</span>",';
            $test .= '"'.$aCust['user_address'].'<br>'.$aCust['user_district'].' ';
            $test .= $aCust['user_amphoe'].' '.$aCust['user_province'].' ';
            $test .= $aCust['user_zipcode'].'",';
            $test .= '"<center>'.number_format($aCust['user_point']).'</center>",';
            $test .= '"<center><button class=\'btn btn-primary mr-2\' onclick=\'infoCust('.$aCust['user_id'].')\''; 
            $test .= 'title=\'ดูข้อมูล\'><i class=\'fas fa-info-circle\'></i>&nbsp;ข้อมูลลูกค้า</button>';
            $test .= '<button class=\'btn btn-warning mr-2\' onclick=\'hisCust('.$aCust['user_id'].')\' title=\'ประวัติการใช้งาน\'>';
            $test .= '<i class=\'fas fa-history\'></i>&nbsp; ประวัติการใช้งาน</button></center>"';
            $test .= '],';
        }
        $test .= ']}';		
        echo str_replace("],]}", "]]}", $test);
    }
    
    public function addCust(){
        $data['provinceData'] = $this->Customer_model->selectProvince();
	    if($this->input->post('confirmBtn')){
            $addData['addName'] = $this->input->post('addName');
            $addData['addPhone'] = $this->input->post('addPhone');
            $addData['addAddress'] = $this->input->post('addAddress');
            $addData['addProvince'] = $this->input->post('addProvince');
            $addData['addAmphoe'] = $this->input->post('addAmphoe');
            $addData['addDistrict'] = $this->input->post('addDistrict');
            $addData['addZipcode'] = $this->input->post('addZipcode');
            
            $this->Customer_model->addCustbyStaff($addData);
            redirect(base_url('service'));
        }
        $this->load->view('addCust', $data); 
	}

    public function infoCust(){
        $custID = $_POST['custID'];
        $infoCust = $this->Customer_model->infoCust($custID);
        echo json_encode($infoCust);
    }

    public function hisCust(){
        $custID = $_POST['custID'];
        $hisCust = $this->Customer_model->hisCust($custID);
        echo json_encode($hisCust);
    }

    public function detailWS(){
        $wsID = $_POST['wsID'];
        $detailWS = $this->Customer_model->detailWS($wsID);
        echo json_encode($detailWS);
    }

    public function selectAmphoe(){ 
		$province = $_POST['province'];
		$selectAmphoe = $this->Customer_model->selectAmphoe($province);
		echo json_encode($selectAmphoe);
	}

	public function selectDistrict(){
		$amphoe = $_POST['amphoe'];
		$selectAmphoe = $this->Customer_model->selectDistrict($amphoe);
		echo json_encode($selectAmphoe);
	}
	
	public function selectZipcode(){
		$district = $_POST['district'];
		$province = $_POST['province'];
		$amphoe = $_POST['amphoe'];
		$selectZipcode = $this->Customer_model->selectZipcode($district, $province, $amphoe);
		echo json_encode($selectZipcode);
	}

    public function updateDataCust(){
        $updateCust['ID'] = $_POST['custID'];
        $updateCust['Name'] = $_POST['custName'];
        $updateCust['Phone'] = $_POST['custPhone'];
        $updateCust['Address'] = $_POST['custAddress'];
        $updateCust['District'] = $_POST['custDistrict'];
        $updateCust['Amphoe'] = $_POST['custAmphoe'];
        $updateCust['Province'] = $_POST['custProvince'];
        $updateCust['Zipcode'] = $_POST['custZipcode'];

        $updateDataCust = $this->Customer_model->updateDataCust($updateCust);
        echo '1';
    }
}
?>