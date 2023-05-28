<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Voucher extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Voucher_model');
        $this->load->library('session');
	}

    public function index(){
		if(!$this->session->userdata('staff_ses_name')){
            redirect(base_url('logout'));
		}

        $this->load->view('voucher');
    }

    public function allReVoucher(){
        $allCust = $this->Voucher_model->allReVoucher();
        $test = '{"data": [';
        foreach($allCust as $aCust){
            $uID = $aCust['user_id'];
            $lvID = $aCust['log_v_id'];

            $test .= '[';

            $test .= '"<center>'.$aCust['user_id'].'</center>",';

            $test .= '"'.$aCust['user_name'].'<br>';
            $test .= '<span class=\'text-secendary\' style=\'font-size: .7rem;\'>#Tel: '.$aCust['user_phone'].'</span>",';

            $test .= '"<center><b>';
            $dd = explode(" ", $aCust['log_v_date']);
            $test .= $dd[0].'<br>'.$dd[1];
            $test .= '</b></center>",';

            $test .= '"<center><b>'.number_format($aCust['voucher_discount'],0).'</b></center>",';
            
            $test .= '"<center><button class=\'btn btn-warning mr-2\' onclick=\'useVoucher('.$uID.','.$lvID.')\''; 
            $test .= 'title=\'ดูข้อมูล\'>ใช้ส่วนลด</button>"';
            $test .= '],';
        }
        $test .= ']}';		
        echo str_replace("],]}", "]]}", $test);
    }

    public function reVoucher(){
        $allCust = $this->Voucher_model->reVoucher();
        $test = '{"data": [';
        foreach($allCust as $aCust){
            $test .= '[';

            $test .= '"<center>'.$aCust['user_id'].'</center>",';

            $test .= '"'.$aCust['user_name'].'<br>';
            $test .= '<span class=\'text-secendary\' style=\'font-size: .7rem;\'>#Tel: '.$aCust['user_phone'].'</span>",';

            $test .= '"<center><b>';
            $dd = explode(" ", $aCust['log_v_date']);
            $test .= $dd[0].'<br>'.$dd[1];
            $test .= '</b></center>",';

            $test .= '"<center><b>';
            $ddd = explode(" ", $aCust['log_v_usedate']);
            $test .= $ddd[0].'<br>'.$ddd[1];
            $test .= '</b></center>",';

            $test .= '"<center><b>'.number_format($aCust['voucher_discount'],0).'</b></center>"';
            $test .= '],';
        }
        $test .= ']}';		
        echo str_replace("],]}", "]]}", $test);
    }

    public function updateV(){
        $uID = $_POST['uID'];
        $lvID = $_POST['lvID'];

        $this->Voucher_model->updateVU($uID);

        $this->Voucher_model->updateLVU($lvID);

        echo json_encode('success');
    }

}