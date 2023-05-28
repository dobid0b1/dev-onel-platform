<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Track_modal extends CI_Model {

    public function allTrackByUserID($userID){
        $query = " SELECT * FROM history 
                    JOIN worksheet ON worksheet.worksheet_id = history.worksheet_id
                    WHERE user_id = '$userID'
                    AND worksheet_flag = '0'
                    ORDER BY worksheet_create_date ASC ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

}