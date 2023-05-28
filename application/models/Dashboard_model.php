<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Dashboard_model extends CI_Model {

    public function allWorksheetInProcess(){
        $query = " SELECT * FROM worksheet
                    JOIN history ON history.worksheet_id = worksheet.worksheet_id
                    JOIN user ON user.user_id = history.user_id
                    WHERE worksheet_flag = '0'
                    ORDER BY worksheet.worksheet_create_date DESC";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function top5(){
        $query = " SELECT `user_name`, 
                            SUM(`worksheet_credit`) as countAll, 
                            COUNT(`worksheet`.`worksheet_id`) as countWS
                    FROM `worksheet`
                    JOIN `history` ON `history`.`worksheet_id` = `worksheet`.`worksheet_id`
                    JOIN `user` ON `user`.`user_id` = `history`.`user_id`
                    WHERE `worksheet_get_money` != ''
                    AND `worksheet_get_money` != '0000-00-00 00:00:00'
                    GROUP BY `history`.`user_id`
                    ORDER BY countAll DESC
                    LIMIT 0,5 ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function showSuccessWorksheet(){
        $query = " SELECT * FROM worksheet
                    JOIN history ON history.worksheet_id = worksheet.worksheet_id
                    JOIN user ON user.user_id = history.user_id
                    WHERE worksheet_flag = '1'
                    AND worksheet_credit != ''
                    AND worksheet_get_money != '' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function showNomoneyWorksheet(){
        $query = " SELECT * FROM worksheet
                    JOIN history ON history.worksheet_id = worksheet.worksheet_id
                    JOIN user ON user.user_id = history.user_id
                    WHERE worksheet_flag = '1'
                    AND (worksheet_credit = ''
                    OR worksheet_get_money = '0000-00-00 00:00:00'
                    OR worksheet_get_money IS NULL) ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function countWorksheet(){
        $query = " SELECT COUNT(*) as allCount, 
                            SUM(CASE WHEN worksheet_status = 'รอส่งร้าน' THEN 1 ELSE 0 END) as w, 
                            SUM(CASE WHEN worksheet_status = 'ร้านรับแล้ว' THEN 1 ELSE 0 END) as r, 
                            SUM(CASE WHEN worksheet_status = 'ส่งคืนแล้ว' THEN 1 ELSE 0 END) as s
                    FROM worksheet ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function getDetailWorksheet($wsID){
        $query = " SELECT * FROM worksheet 
                    JOIN history ON history.worksheet_id = worksheet.worksheet_id
                    JOIN user ON user.user_id = history.user_id
                    WHERE worksheet.worksheet_id = '$wsID' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function datalistTrack(){
        $query = " SELECT worksheet_track FROM worksheet WHERE worksheet_track != '' GROUP BY worksheet_track ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }
    
    public function allStaff(){
        $query = " SELECT * FROM staff WHERE staff_flag = '1' AND staff_level != 'admin' ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function updateWorksheetData($wsData){
        $wsID = $wsData['wsID'];
        $wsTrack = $wsData['wsTrack'];
        $wsRD = $wsData['wsRD'];
        $wsED = $wsData['wsED'];
        $wsStaff = $wsData['wsStaff'];
        $wsPrice = $wsData['wsPrice'];
        $providerLogis = $wsData['providerLogis'];
        $tagLogis = $wsData['tagLogis'];
        $dateMoney = $wsData['dateMoney'];
        $comment = $wsData['comment'];


        if($wsRD == 'ไม่มีข้อมูล'){ 
            $flag = '0'; 

            $query = " UPDATE `worksheet` 
                    SET `worksheet_track` = '$wsTrack',
                        `worksheet_flag` = '$flag',
                        `worksheet_staff` = '$wsStaff',
                        `worksheet_credit` = '$wsPrice',
                        `worksheet_get_money` = '$dateMoney',
                        `worksheet_comment` = '$comment'
                    WHERE `worksheet_id` = '$wsID' ";
        }

        else if($wsED == 'ไม่มีข้อมูล'){ 
            $flag = '0'; 
            $status = 'ร้านรับแล้ว';

            $query = " UPDATE `worksheet` 
                    SET `worksheet_receive_date` = '$wsRD',
                        `worksheet_status` = '$status',
                        `worksheet_track` = '$wsTrack',
                        `worksheet_flag` = '$flag',
                        `worksheet_staff` = '$wsStaff',
                        `worksheet_credit` = '$wsPrice',
                        `worksheet_get_money` = '$dateMoney',
                        `worksheet_comment` = '$comment'
                    WHERE `worksheet_id` = '$wsID' ";
        }
        else{ 
            $flag = '1'; 
            $status = 'ส่งคืนแล้ว';

            $query = " UPDATE `worksheet` 
                    SET `worksheet_receive_date` = '$wsRD',
                        `worksheet_end_date` = '$wsED',
                        `worksheet_status` = '$status',
                        `worksheet_track` = 'ส่งคืนลูกค้าแล้ว',
                        `worksheet_flag` = '$flag',
                        `worksheet_staff` = '$wsStaff',
                        `worksheet_credit` = '$wsPrice',
                        `worksheet_provider_logis` = '$providerLogis',
                        `worksheet_tag_logis` = '$tagLogis',
                        `worksheet_get_money` = '$dateMoney',
                        `worksheet_comment` = '$comment'
                    WHERE `worksheet_id` = '$wsID' ";
        }
        $exec = $this->db->query($query);
        return $query;
    }

    public function countWSStaff(){
        $query = " SELECT COUNT(`worksheet`.`worksheet_id`) as countWS,
                            `staff`.`staff_name`,
                            `staff`.`staff_position`
                    FROM `staff`
                    JOIN `worksheet` ON `worksheet`.`worksheet_staff` = `staff`.`staff_name`
                    WHERE `staff`.`staff_level` != 'admin'
                    AND `worksheet`.`worksheet_flag` = '0'
                    GROUP BY `staff`.`staff_name`
                    ORDER BY countWS DESC ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->result_array():array();
    }

    public function getDataChart(){
        $query = " SELECT SUM(CASE WHEN worksheet_type = 'bag' THEN 1 ELSE 0 END) as Bag, 
                            SUM(CASE WHEN worksheet_type = 'shoe' THEN 1 ELSE 0 END) as Shoe, 
                            SUM(CASE WHEN worksheet_type = 'other' THEN 1 ELSE 0 END) as Other 
                    FROM `worksheet` ";
        $exec = $this->db->query($query);
        return ($exec->num_rows() > 0 )?$exec->row():array();
    }
}