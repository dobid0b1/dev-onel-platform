<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Member_model extends CI_Model {

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

    public function selectZipcode($district){
        $query = " SELECT `zipcode` FROM `districts` WHERE `district` = '$district' GROUP BY `zipcode` ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function checkMember($insertData){
        $lineID = $insertData['lineID'];
        $query = " SELECT * FROM `user` WHERE `user_line_id` = '$lineID' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }
    
    public function checkMemberbyPhone($insertData){
        $phone = $insertData['memberPhone'];
        $query = " SELECT * FROM `user` WHERE `user_phone` = '$phone' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function insertDataInformation($insertData){
        $query = " INSERT INTO `user`(`user_name`, `user_phone`, `user_line_id`, `user_address`, `user_province`, `user_amphoe`, `user_district`, `user_zipcode`) 
                    VALUES ('".$insertData['memberName']."','".$insertData['memberPhone']."','".$insertData['lineID']."',
                            '".$insertData['memberAddress']."','".$insertData['nameProvince']."','".$insertData['nameAmphoe']."',
                            '".$insertData['nameDistrict']."','".$insertData['zipcode']."') ";
        $exec = $this->db->query($query);
    }

    public function updateDataInformation($insertData){
        $lineID = $insertData['lineID'];
        $memberName = $insertData['memberName'];
        $memberAddress = $insertData['memberAddress'];
        $nameProvince = $insertData['nameProvince'];
        $nameAmphoe = $insertData['nameAmphoe'];
        $nameDistrict = $insertData['nameDistrict'];
        $zipcode = $insertData['zipcode'];
        $memberPhone = $insertData['memberPhone'];

        $query = " UPDATE `user` 
                    SET `user_line_id` = '$lineID',
                        `user_name` = '$memberName',
                        `user_address` = '$memberAddress',
                        `user_province` = '$nameProvince',
                        `user_amphoe` = '$nameAmphoe',
                        `user_district` = '$nameDistrict',
                        `user_zipcode` = '$zipcode'
                    WHERE `user_phone` = '$memberPhone' ";
        $exec = $this->db->query($query);
    }

    public function editDataProvince($lineID){
        $query = " UPDATE `user` 
                    SET `user_province` = ''
                    WHERE `user_line_id` = '$lineID' ";
        $exec = $this->db->query($query);
    }

}