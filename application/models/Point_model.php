<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Point_model extends CI_Model { 

    public function allVoucher() {
        $query = "SELECT * FROM voucher";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }
}