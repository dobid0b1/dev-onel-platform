<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Service_model extends CI_Model { 

    public function allBrand() {
        $query = "SELECT * FROM brand";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function allCust() {
        $query = "SELECT * FROM user";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function checkCust($lineID){
        $query = " SELECT * FROM user WHERE user_line_id = '$lineID' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function insertWorksheet($insertData){
        $dateToday = $insertData['today'];
        $imgOne = $insertData['imgOne'];
        $imgTwo = $insertData['imgTwo'];
        $type = $insertData['type'];
        $brand = $insertData['brand'];
        $subbrand = $insertData['subbrand'];
        $comment = $insertData['comment'];
        $serviceType = $insertData['serviceType'];

        $query = " INSERT INTO `worksheet`(`worksheet_receive_date`, `worksheet_status`, `worksheet_track`,
                                            `worksheet_flag`, `worksheet_service_type`, `worksheet_type`, 
                                            `worksheet_brand`, `worksheet_subbrand`, 
                                            `worksheet_comment`, `worksheet_img_path_one`, 
                                            `worksheet_img_path_two`) 
                    VALUES ('$dateToday','ร้านรับแล้ว','พนักงานรับสินค้าแล้ว',
                            '0','$serviceType','$type','$brand',
                            '$subbrand','$comment','$imgOne','$imgTwo') ";
        $exec = $this->db->query($query);
        return $this->db->insert_id();
    }

    public function insertHistory($insertData){
        $userID = $insertData['userID'];
        $wsID = $insertData['wsID'];
        // $lineID = $insertData['lineID'];

        $query = " INSERT INTO `history`(`worksheet_id`, `user_id`) 
                    VALUES ('$wsID', '$userID')";
        $exec = $this->db->query($query);
    }
}