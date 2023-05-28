<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Staff_model extends CI_Model {

    public function datalistPosotion(){
        $query = " SELECT staff_position FROM `staff` WHERE staff_level != 'admin' GROUP BY staff_position";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function addStaff($addStaffData){
        $addUserName = $addStaffData['addUserName'];
        $addPassword = $addStaffData['addPassword'];
        $addName = $addStaffData['addName'];
        $addPosition = $addStaffData['addPosition'];
        $addLevel = $addStaffData['addLevel'];

        $query = " INSERT INTO `staff`(`staff_username`, `staff_password`, 
                                        `staff_name`, `staff_position`, `staff_level`) 
                    VALUES ('$addUserName','$addPassword','$addName','$addPosition','$addLevel') ";
        $exec = $this->db->query($query);
    }

    public function allStaff(){
        $query = " SELECT * FROM `staff` WHERE staff_position != 'ผู้ดูแลระบบ'";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function infoStaff($staffID){
        $query = " SELECT * FROM `staff` WHERE staff_id = '$staffID' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function updateStaff($updateStaffData){
        $staffID = $updateStaffData['staffID'];
        $updateUser = $updateStaffData['updateUser'];
        $updatePass = $updateStaffData['updatePass'];
        $updateName = $updateStaffData['updateName'];
        $updatePosition = $updateStaffData['updatePosition'];
        $updateLevel = $updateStaffData['updateLevel'];

        $query = " UPDATE `staff` 
                    SET `staff_username` = '$updateUser ',
                        `staff_password` = '$updatePass',
                        `staff_name` = '$updateName',
                        `staff_position` = '$updatePosition',
                        `staff_level` = '$updateLevel'
                    WHERE `staff_id` = '$staffID' ";
        $exec = $this->db->query($query);
    }

    public function changeFlag($staffID, $flag){
        $query = " UPDATE `staff` 
                    SET `staff_flag` = '$flag'
                    WHERE `staff_id` = '$staffID' ";
        $exec = $this->db->query($query);
    }

}