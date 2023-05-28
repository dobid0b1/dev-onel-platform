<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Voucher_modal extends CI_Model {

    public function allVoucher(){
        $query = " SELECT * FROM voucher ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function detailVoucher($vID){
        $query = " SELECT * FROM voucher WHERE voucher_id = '$vID' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function detailMember($uID){
        $query = " SELECT * FROM user WHERE user_id = '$uID' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function editPoint($uID, $currentPoint){
        $query = " UPDATE `user` 
                    SET `user_point` = '$currentPoint',
                        `user_voucher_flag` = '1'
                    WHERE `user_id` = '$uID' ";
        $exec = $this->db->query($query);
    }

    public function insertVLog($uID, $vID, $usePoint, $currentPoint){
        $today = date('Y-m-d H:i:s');
        $query = " INSERT INTO `log_voucher`(`voucher_id`, `user_id`, `log_v_point`, `log_v_point_cur`, `log_v_date`, `log_v_flag`) 
                    VALUES ('$vID','$uID','$usePoint','$currentPoint','$today','1') ";
        $exec = $this->db->query($query);
    }
}