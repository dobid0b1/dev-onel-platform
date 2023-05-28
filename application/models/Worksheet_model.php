<?php
date_default_timezone_set("Asia/Bangkok");
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Worksheet_model extends CI_Model {

    public function allBrand(){
        $query = " SELECT * FROM `brand` ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function allCust(){
        $query = " SELECT * FROM `user` WHERE user_line_id != 'administrator' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function selectPhone($custID){
        $query = " SELECT * FROM `user` WHERE user_id = '$custID' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();

    }

    public function addWorksheet($addWSData){
        $today = $addWSData['today'];
        $custType = $addWSData['custType'];
        $custBrand = $addWSData['brand'];
        $custSubbrand = $addWSData['subbrand'];
        $custComment = $addWSData['comment'];
        $img1 = $addWSData['imgOne'];
        $img2 = $addWSData['imgTwo'];
        $serviceType = $addWSData['serviceType'];

        $query = " INSERT INTO `worksheet`(`worksheet_receive_date`, `worksheet_status`, 
                                            `worksheet_flag`, `worksheet_service_type`, `worksheet_type`, `worksheet_track`, 
                                            `worksheet_brand`, `worksheet_subbrand`, 
                                            `worksheet_comment`, `worksheet_img_path_one`, `worksheet_img_path_two`) 
                    VALUES ('$today','ร้านรับแล้ว','0','$serviceType','$custType','พนักงานรับสินค้าแล้ว', '$custBrand','$custSubbrand','$custComment',
                            '$img1','$img2') ";
        $exec = $this->db->query($query);
        return $this->db->insert_id();
    }

    public function addHistory($addWSData){
        $wsID = $addWSData['insertID'];
        $custID = $addWSData['custID'];

        $query = " INSERT INTO `history`(`worksheet_id`, `user_id`) 
                    VALUES ('$wsID', '$custID') ";
        $exec = $this->db->query($query);
    }

    public function checkUser($custID){
        $query = " SELECT user_line_id FROM `user` WHERE user_id = '$custID' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->row():array();
    }

    public function selectDataUser($wsID){
        $query = " SELECT * FROM `worksheet` 
                    JOIN `history` ON `history`.`worksheet_id` = `worksheet`.`worksheet_id`
                    JOIN `user` ON `user`.`user_id` = `history`.`user_id`
                    WHERE `worksheet`.`worksheet_id` = '$wsID' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->row():array();
    }

    public function addPointUser($userID, $plusCredit){
        $query = " UPDATE `user` 
                    SET `user_point` = '$plusCredit'
                    WHERE `user_id` = '$userID' ";
        $exec = $this->db->query($query);
        return $query;
    }

    public function changeFlagPoint($wsID){
        $query = " UPDATE `worksheet` 
                    SET `worksheet_point_flag` = '1'
                    WHERE `worksheet_id` = '$wsID' ";
        $exec = $this->db->query($query);
        return $query;
    }

}
?>