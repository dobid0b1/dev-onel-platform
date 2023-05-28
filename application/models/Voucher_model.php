<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Voucher_model extends CI_Model {

    public function allReVoucher(){
        $query = " SELECT * FROM `log_voucher`
                    JOIN `user` ON `user`.`user_id` = `log_voucher`.`user_id`
                    JOIN `voucher` ON `voucher`.`voucher_id` = `log_voucher`.`voucher_id`
                    WHERE `log_v_flag` = '1' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function reVoucher(){
        $query = " SELECT * FROM `log_voucher`
                    JOIN `user` ON `user`.`user_id` = `log_voucher`.`user_id`
                    JOIN `voucher` ON `voucher`.`voucher_id` = `log_voucher`.`voucher_id`
                    WHERE `log_v_flag` = '0' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function updateVU($uID){
        $today = date('Y-m-d H:i:s');
        $query = " UPDATE `user` 
                    SET `user_voucher_flag` = '0'
                    WHERE `user_id` = '$uID' ";
        $exec = $this->db->query($query);
    }

    public function updateLVU($lvID){
        $today = date('Y-m-d H:i:s');
        $query = " UPDATE `log_voucher` 
                    SET `log_v_usedate` = '$today',
                        `log_v_flag` = '0'
                    WHERE `log_v_id` = '$lvID' ";
        $exec = $this->db->query($query);
    }

}