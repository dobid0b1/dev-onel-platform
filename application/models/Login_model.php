<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Login_model extends CI_Model {

    public function checkStaff($dataLogin){
        $userName = $dataLogin["userName"];
        $passWord = $dataLogin["passWord"];

        $query = "SELECT * FROM `staff`
                    WHERE `staff_username` = '$userName'
                    AND `staff_password` = '$passWord'
                    AND `staff_flag` = '1' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->row():array();
    }

}