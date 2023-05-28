<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class DB_model extends CI_Model { 
    public function select_brand_name() {
        $query = "SELECT * FROM brand";
        $exec = $this->db->query($query);
        if($exec->num_rows() > 0 ) {
            return $exec->result_array();
        } else {
            return array();
        }
    }

    public function select_member($line_id) {
        $query = "SELECT * FROM `user` 
                    WHERE `user_name` != ''
                    AND `user_phone` != ''
                    AND `user_line_id` != ''
                    AND `user_address` != ''
                    AND `user_province` != ''
                    AND `user_amphoe` != ''
                    AND `user_district` != ''
                    AND `user_zipcode` != ''
                    AND `user_line_id` = '$line_id'";
        $exec = $this->db->query($query);
        if($exec->num_rows() > 0 ) {
            return $exec->result_array();
        } else {
            return array();
        }
    }
}