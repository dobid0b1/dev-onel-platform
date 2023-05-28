<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
        $this->load->model('Login_model');
	}

    public function index(){
        if($this->input->post('btnLogin')){
            $dataLogin['userName'] = $this->input->post('userLogin');
            $dataLogin['passWord'] = $this->input->post('passLogin');

            $checkStaff = $this->Login_model->checkStaff($dataLogin);
            if($checkStaff){
                $staff_ses = array(
    				"staff_ses_id" => $checkStaff->staff_id,
    				"staff_ses_name" => $checkStaff->staff_name,
    				"staff_ses_position" => $checkStaff->staff_position,
    				"staff_ses_level" => $checkStaff->staff_level
    			);
				$this->session->set_userdata($staff_ses);
                redirect('dashboard');
            }else{
                $this->session->set_flashdata('status','2');
                redirect('login');
            }
        }

        $this->load->view('login');
    }
} 
?>