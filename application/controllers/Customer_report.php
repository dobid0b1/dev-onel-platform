<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer_report extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Report_model');
		$this->load->model('Customer_model');
	}

    public function index() {
		if(!$this->session->userdata('staff_ses_name')){
            redirect(base_url('logout'));
		}

        if(isset($_GET['selected'])){
            $userID = $_GET['selected'];
            if(isset($_GET['date'])) {
                if($_GET['date'] == 'all'){
                    $data['sumAllCredit'] = $this->Report_model->sumAllCreditSelect($userID);
                    $data['worksheet'] = $this->Report_model->select_worksheetSelect($userID);
                }
                else if($_GET['date'] == 'today'){
                    $value = $_GET['value'];
                    $data['sumAllCredit'] = $this->Report_model->sumCreditSelect($value, $userID);
                    $data['worksheet'] = $this->Report_model->selectWorksheetSelect($value, $userID);
                }
                else if($_GET['date'] == 'month'){
                    $value = $_GET['value'];
                    $data['sumAllCredit'] = $this->Report_model->sumCreditSelect($value, $userID);
                    $data['worksheet'] = $this->Report_model->selectWorksheetSelect($value, $userID);
                }else{
                    $data['sumAllCredit'] = $this->Report_model->sumAllCreditSelect();
                    $data['worksheet'] = $this->Report_model->select_worksheetSelect();
                }
            }
            else {
                $data['sumAllCredit'] = $this->Report_model->sumAllCreditSelect($userID);
                $data['worksheet'] = $this->Report_model->select_worksheetSelect($userID);
            }

            if(isset($_GET['dateStart'])){
                $dateStart = $_GET['dateStart'];
                $dateEnd = $_GET['dateEnd'];
                $userID = $_GET['selected'];

                $data['sumAllCredit'] = $this->Report_model->sumCreditBeSelect($dateStart, $dateEnd, $userID);
                $data['worksheet'] = $this->Report_model->selectWorksheetBeSelect($dateStart, $dateEnd, $userID);
            }
        }

        $data['allCust'] = $this->Customer_model->allCust();

        $this->load->view('customer_report', $data);      
    }


}
