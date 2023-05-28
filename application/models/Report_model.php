<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Report_model extends CI_Model {
    
    public function select_worksheet() {
        $query = " SELECT * FROM `worksheet`
                    WHERE `worksheet_get_money` != ''
                    AND `worksheet_get_money` != '0000-00-00 00:00:00' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function selectWorksheet($date) {
        $query = " SELECT * FROM `worksheet`
                    WHERE `worksheet_get_money` LIKE '%$date%'";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function sumAllCredit(){
        $query = " SELECT SUM(CASE WHEN `worksheet_type` = 'bag' THEN `worksheet_credit` ELSE 0 END) as Bag,
                            SUM(CASE WHEN `worksheet_type` = 'shoe' THEN `worksheet_credit` ELSE 0 END) as Shoe,
                            SUM(CASE WHEN `worksheet_type` = 'other' THEN `worksheet_credit` ELSE 0 END) as Other
                    FROM `worksheet`
                    WHERE `worksheet_get_money` != ''
                    AND `worksheet_get_money` != '0000-00-00 00:00:00' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->row():array();
    }

    public function sumCredit($date){
        $query = " SELECT SUM(CASE WHEN `worksheet_type` = 'bag' THEN `worksheet_credit` ELSE 0 END) as Bag,
                            SUM(CASE WHEN `worksheet_type` = 'shoe' THEN `worksheet_credit` ELSE 0 END) as Shoe,
                            SUM(CASE WHEN `worksheet_type` = 'other' THEN `worksheet_credit` ELSE 0 END) as Other
                    FROM `worksheet`
                    WHERE `worksheet_get_money` LIKE '%$date%' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->row():array();
    }

    public function sumCreditBe($dateStart, $dateEnd){
        $query = " SELECT SUM(CASE WHEN `worksheet_type` = 'bag' THEN `worksheet_credit` ELSE 0 END) as Bag,
                            SUM(CASE WHEN `worksheet_type` = 'shoe' THEN `worksheet_credit` ELSE 0 END) as Shoe,
                            SUM(CASE WHEN `worksheet_type` = 'other' THEN `worksheet_credit` ELSE 0 END) as Other
                    FROM `worksheet`
                    WHERE `worksheet_get_money` >= '$dateStart'
                    AND `worksheet_get_money` <= '$dateEnd' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->row():array();
    }

    public function selectWorksheetBe($dateStart, $dateEnd) {
        $query = " SELECT * FROM `worksheet`
                    WHERE `worksheet_get_money` >= '$dateStart'
                    AND `worksheet_get_money` <= '$dateEnd' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }




    public function sumAllCreditSelect($userID = NULL){
        $query = " SELECT SUM(CASE WHEN `worksheet_type` = 'bag' THEN `worksheet_credit` ELSE 0 END) as Bag,
                            SUM(CASE WHEN `worksheet_type` = 'shoe' THEN `worksheet_credit` ELSE 0 END) as Shoe,
                            SUM(CASE WHEN `worksheet_type` = 'other' THEN `worksheet_credit` ELSE 0 END) as Other
                    FROM `worksheet`
                    JOIN `history` ON `history`.`worksheet_id` = `worksheet`.`worksheet_id`
                    WHERE `worksheet_get_money` != ''
                    AND `worksheet_get_money` != '0000-00-00 00:00:00'
                    AND `history`.`user_id` = '$userID' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->row():array();
    }
    public function select_worksheetSelect($userID = NULL) {
        $query = " SELECT * FROM `worksheet`
                    JOIN `history` ON `history`.`worksheet_id` = `worksheet`.`worksheet_id`
                    WHERE `worksheet_get_money` != ''
                    AND `worksheet_get_money` != '0000-00-00 00:00:00'
                    AND `history`.`user_id` = '$userID' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }
    public function selectWorksheetSelect($date, $userID = NULL) {
        $query = " SELECT * FROM `worksheet`
                    JOIN `history` ON `history`.`worksheet_id` = `worksheet`.`worksheet_id`
                    WHERE `worksheet_get_money` LIKE '%$date%'
                    AND `history`.`user_id` = '$userID' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }
    public function sumCreditSelect($date, $userID = NULL){
        $query = " SELECT SUM(CASE WHEN `worksheet_type` = 'bag' THEN `worksheet_credit` ELSE 0 END) as Bag,
                            SUM(CASE WHEN `worksheet_type` = 'shoe' THEN `worksheet_credit` ELSE 0 END) as Shoe,
                            SUM(CASE WHEN `worksheet_type` = 'other' THEN `worksheet_credit` ELSE 0 END) as Other
                    FROM `worksheet`
                    JOIN `history` ON `history`.`worksheet_id` = `worksheet`.`worksheet_id`
                    WHERE `worksheet_get_money` LIKE '%$date%' 
                    AND `history`.`user_id` = '$userID' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->row():array();
    }
    public function sumCreditBeSelect($dateStart, $dateEnd, $userID = NULL){
        $query = " SELECT SUM(CASE WHEN `worksheet_type` = 'bag' THEN `worksheet_credit` ELSE 0 END) as Bag,
                            SUM(CASE WHEN `worksheet_type` = 'shoe' THEN `worksheet_credit` ELSE 0 END) as Shoe,
                            SUM(CASE WHEN `worksheet_type` = 'other' THEN `worksheet_credit` ELSE 0 END) as Other
                    FROM `worksheet`
                    JOIN `history` ON `history`.`worksheet_id` = `worksheet`.`worksheet_id`
                    WHERE `worksheet_get_money` >= '$dateStart'
                    AND `worksheet_get_money` <= '$dateEnd' 
                    AND `history`.`user_id` = '$userID' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->row():array();
    }
    public function selectWorksheetBeSelect($dateStart, $dateEnd, $userID = NULL) {
        $query = " SELECT * FROM `worksheet`
                    JOIN `history` ON `history`.`worksheet_id` = `worksheet`.`worksheet_id`
                    WHERE `worksheet_get_money` >= '$dateStart'
                    AND `worksheet_get_money` <= '$dateEnd' 
                    AND `history`.`user_id` = '$userID' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }
    public function selectDataUser($userIDSelect){
        $query = " SELECT * FROM `user` WHERE `user_id` = '$userIDSelect' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->row():array();
    }
}