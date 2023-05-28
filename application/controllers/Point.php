<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Point extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Point_model');
	}
	public function index() {
		if(!$this->session->userdata('staff_ses_name')){
            redirect(base_url('logout'));
		}
		$data['allVoucher'] = $this->Point_model->allVoucher();

		$this->load->view('point', $data); 
    }
}