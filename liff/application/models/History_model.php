<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class History_model extends CI_Model {

    public function allHistoryByUserID($userID){
        $query = " SELECT * FROM history 
                    JOIN worksheet ON worksheet.worksheet_id = history.worksheet_id
                    WHERE user_id = '$userID'
                    ORDER BY worksheet_flag , worksheet_create_date ASC
                    LIMIT 0,20 ";
        $exec = $this->db->query($query);
        if($exec->num_rows() > 0 ) {
            return $exec->result_array();
        } else {
            return array();
        }
    }

    public function getDataWorksheet($wsID){
        $query = " SELECT * FROM worksheet WHERE worksheet_id = '$wsID'";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }
}