<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Customer_model extends CI_Model {

    public function allCust(){
        $query = " SELECT * FROM `user` WHERE user_line_id != 'administrator'";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function infoCust($custID){
        $query = " SELECT * FROM `user` WHERE user_id = '$custID'";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function checkCust($addData){
        $phone = $addData['addPhone'];

        $query = " SELECT * FROM `user` WHERE user_phone = '$phone'";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function hisCust($custID){
        $query = " SELECT * FROM history 
                    JOIN worksheet ON worksheet.worksheet_id = history.worksheet_id
                    WHERE user_id = '$custID'
                    ORDER BY worksheet_flag , worksheet_create_date ASC";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function detailWS($wsID){
        $query = " SELECT * FROM worksheet WHERE worksheet_id = '$wsID' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function updateDataCust($updateData){
        $userID = $updateData['ID'];
        $userName = $updateData['Name'];
        $userPhone = $updateData['Phone'];
        $userAddress = $updateData['Address'];
        $userProvince = $updateData['Province'];
        $userAmphoe = $updateData['Amphoe'];
        $userDistrict = $updateData['District'];
        $userZipcode = $updateData['Zipcode'];

        $query = "  UPDATE `user` 
                    SET `user_name` = '$userName',
                        `user_phone` = '$userPhone',
                        `user_address` = '$userAddress',
                        `user_province` = '$userProvince',
                        `user_amphoe` = '$userAmphoe',
                        `user_district` = '$userDistrict',
                        `user_zipcode` = '$userZipcode'
                    WHERE `user_id` = '$userID' ";
        $exec = $this->db->query($query);
    }

    public function selectProvince(){
        $query = " SELECT `province` FROM `districts` GROUP BY `province` ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function selectAmphoe($province){
        $query = " SELECT `amphoe` FROM `districts` WHERE `province` = '$province' GROUP BY `amphoe` ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function selectDistrict($amphoe){
        $query = " SELECT `district` FROM `districts` WHERE `amphoe` = '$amphoe' GROUP BY `district` ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function selectZipcode($district, $province = '', $amphoe = ''){
        $query = " SELECT `zipcode` FROM `districts` 
                    WHERE `district` = '$district' AND `province` = '$province' AND `amphoe` = '$amphoe'
                    GROUP BY `zipcode` ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function addCustbyStaff($addData){
        $addName = $addData['addName'];
        $addPhone = $addData['addPhone'];
        $addAddress = $addData['addAddress'];
        $addProvince = $addData['addProvince'];
        $addAmphoe = $addData['addAmphoe'];
        $addDistrict = $addData['addDistrict'];
        $addZipcode = $addData['addZipcode'];

        $query = "  INSERT INTO `user`(`user_name`, `user_phone`,
                                        `user_address`, `user_province`, 
                                        `user_amphoe`, `user_district`, `user_zipcode`) 
                    VALUES ('$addName','$addPhone',
                            '$addAddress','$addProvince','$addAmphoe',
                            '$addDistrict','$addZipcode') ";
        $exec = $this->db->query($query);
    }
}