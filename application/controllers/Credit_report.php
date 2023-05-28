<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Credit_report extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Report_model');
	}

    public function index() {
		if(!$this->session->userdata('staff_ses_name')){
            redirect(base_url('logout'));
		}

		if(isset($_GET['date'])) {
			if($_GET['date'] == 'all'){
				$data['sumAllCredit'] = $this->Report_model->sumAllCredit();
				$data['worksheet'] = $this->Report_model->select_worksheet();
			}
			else if($_GET['date'] == 'today'){
				$value = $_GET['value'];
				$data['sumAllCredit'] = $this->Report_model->sumCredit($value);
				$data['worksheet'] = $this->Report_model->selectWorksheet($value);
			}
			else if($_GET['date'] == 'month'){
				$value = $_GET['value'];
				$data['sumAllCredit'] = $this->Report_model->sumCredit($value);
				$data['worksheet'] = $this->Report_model->selectWorksheet($value);
			}else{
				$data['sumAllCredit'] = $this->Report_model->sumAllCredit();
				$data['worksheet'] = $this->Report_model->select_worksheet();
			}
		}
		else {
			$data['sumAllCredit'] = $this->Report_model->sumAllCredit();
			$data['worksheet'] = $this->Report_model->select_worksheet();
		}

		if(isset($_GET['dateStart'])){
			$dateStart = $_GET['dateStart'];
			$dateEnd = $_GET['dateEnd'];

			$data['sumAllCredit'] = $this->Report_model->sumCreditBe($dateStart, $dateEnd);
			$data['worksheet'] = $this->Report_model->selectWorksheetBe($dateStart, $dateEnd);
		}

        $this->load->view('credit_report', $data);      
    }


}
