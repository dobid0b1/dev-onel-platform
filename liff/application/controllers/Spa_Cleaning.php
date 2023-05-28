<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Bangkok');

class Spa_Cleaning extends CI_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->database();
        $this->load->model('DB_model');
	}

    public function index() {
        if(isset($_GET['lineID'])) {
            if($_GET['lineID']) {
                $line_id = $_GET['lineID'];
                $data['member'] = $this->DB_model->select_member($line_id);
                $data['brandname'] = $this->DB_model->select_brand_name();

                $this->load->view('spa_cleaning', $data);
            } 
            else {
                header("location: https://access.line.me/oauth2/v2.1/authorize?app_id=1656240710-mdXq0rXl&client_id=1656240710&scope=chat_message.write+openid+profile&state=mjV2YY5jYOTQ&response_type=code&code_challenge_method=S256&code_challenge=Iyvb9A0hmAjbNWa7sc7kFAJcklkeI5IZiN6E8NB6Oos&liff_sdk_version=2.9.0&type=L&redirect_uri=https%3A%2F%2Fonelth.com%2Fplatform%2Fyesiam%2Fservice&bot_prompt=normal");
            }
        }
        else {
            header("location: https://access.line.me/oauth2/v2.1/authorize?app_id=1656240710-mdXq0rXl&client_id=1656240710&scope=chat_message.write+openid+profile&state=mjV2YY5jYOTQ&response_type=code&code_challenge_method=S256&code_challenge=Iyvb9A0hmAjbNWa7sc7kFAJcklkeI5IZiN6E8NB6Oos&liff_sdk_version=2.9.0&type=L&redirect_uri=https%3A%2F%2Fonelth.com%2Fplatform%2Fyesiam%2Fservice&bot_prompt=normal");
        }
    }

    public function set_upload_options($file_path, $file_name, $file_upload) {
        $config['upload_path']   = $file_path; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
        $config['allowed_types'] = 'jpeg|jpg|png|gif'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
        $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['max_width']     = 0; //ขนาดความกว้างสูงสุด (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
        $config['file_name'] = $file_name;        
        // $config['encrypt_name']  = true; //กำหนดเป็น true ให้ระบบ เปลียนชื่อ ไฟล์  อัตโนมัติ  ป้องกันกรณีชื่อไฟล์ซ้ำกัน

        $this->load->library('upload', $config);
        //ตรวจสอบว่า การ Upload สำเร็จหรือไม่    
        if (!$this->upload->do_upload($file_upload)) {
            $imgUP = '0';
        }
        else {
            $imgUP = '1';
        }

        return $imgUP;
    }

    public function add_data() {
        error_reporting(0);
        $customerGoodsType = $this->input->post('customerGoodsType');
        $customerGoodsBrand = $this->input->post('customerGoodsBrand');
        $customerGoodsModel = $this->input->post('customerGoodsModel');
        $customerGoodsDes = $this->input->post('customerGoodsDes');
        $customerGoodsSize = $this->input->post('customerGoodsSize');

        $line_id = $this->input->post('line_id');

        // echo 'T : '.$customerGoodsType."<br>";
        // echo 'B : '.$customerGoodsBrand."<br>";
        // echo 'M : '.$customerGoodsModel."<br>";
        // echo 'D : '.$customerGoodsDes."<br>";
        // echo 'S : '.$customerGoodsSize."<br>";

        // echo 'line : '.$line_id;        

        if( (!empty($customerGoodsType)) && (!empty($customerGoodsBrand)) && (!empty($customerGoodsModel)) 
            && (!empty($customerGoodsDes)) && (!empty($line_id))) {

            $customerName = $this->input->post('customerName');
            $customerPhone = $this->input->post('customerPhone');
            $customerGoodsType = $this->input->post('customerGoodsType');
            $customerGoodsBrand = $this->input->post('customerGoodsBrand');
            $customerGoodsModel = $this->input->post('customerGoodsModel');
            $customerGoodsDes = $this->input->post('customerGoodsDes');
            $customerGoodsSize = $this->input->post('customerGoodsSize');

            $line_id = $this->input->post('line_id');

            $date_str = date('Ymd');
            $time_str = date('His');

            $date_time = date('Y-m-d H:i:s');                      

            $path = $line_id;
            if (!is_dir("imgUpload/$path/")) {
                mkdir("imgUpload/$path/", 0777, TRUE);
            }

            $filename1 = $date_str."_".$time_str."_1";            
            $file_path = 'imgUpload/'.$path."/";
            $file_name = $filename1;
            $file_upload = 'customerGoodsImage1';

            $up1 = $this->set_upload_options($file_path, $file_name, $file_upload);
            if($up1 == '1') {
                $imageStr1 = $this->upload->data();
                $file1 = $file_path.''.$filename1."".$imageStr1["file_ext"];
                
                $filename2 = $date_str."_".$time_str."_11";
                $file_name2 = $filename2;
                $file_upload2 = 'customerGoodsImage2';
                $up2 = $this->set_upload_options($file_path, $file_name2, $file_upload2);
                if($up2 == '1') {
                    $imageStr2 = $this->upload->data();
                    $file2 = $file_path.''.$filename2."".$imageStr2["file_ext"];

                    $insertWorksheet = "INSERT INTO `worksheet`
                                        (`worksheet_create_date`, `worksheet_status`, `worksheet_type`, `worksheet_brand`, `worksheet_subbrand`, `worksheet_comment`, `worksheet_img_path_one`, `worksheet_img_path_two`) 
                                        VALUES ('$date_time', 'รอส่งร้าน', '$customerGoodsType', '$customerGoodsBrand', '$customerGoodsModel', '$customerGoodsDes', '$file1', '$file2')"; 
                    $exec = $this->db->query($insertWorksheet);
                    if($exec) {
                        $selectWorksheet = "SELECT * FROM `worksheet` 
                                            WHERE worksheet_create_date = '$date_time'
                                            AND worksheet_status = 'รอส่งร้าน'
                                            AND worksheet_type = '$customerGoodsType'
                                            AND worksheet_brand = '$customerGoodsBrand'
                                            AND worksheet_subbrand = '$customerGoodsModel'
                                            AND worksheet_comment = '$customerGoodsDes'
                                            AND worksheet_img_path_one = '$file1'
                                            AND worksheet_img_path_two = '$file2'";
                        $selectWorksheet_exec = $this->db->query($selectWorksheet);
                        if($selectWorksheet_exec->num_rows() > 0 ) {
                            $selectWorksheet_fetch = $selectWorksheet_exec->result_array();
                            
                            $worksheet_id = $selectWorksheet_fetch[0]['worksheet_id'];

                            $selectMember = "SELECT * FROM `user` WHERE `user_line_id` = '$line_id'";
                            $selectMember_exec = $this->db->query($selectMember);
                            if($selectMember_exec->num_rows() > 0 ) {
                                $selectMember_fetch = $selectMember_exec->result_array();

                                $member_id = $selectMember_fetch[0]['user_id'];

                                $insertHistory = "INSERT INTO `history`(`user_line_id`, `worksheet_id`, `user_id`) 
                                                VALUES ('$line_id', '$worksheet_id', '$member_id')";
                                $insertHistory_exec = $this->db->query($insertHistory);    
                                if($insertHistory) {
                                    $this->session->set_flashdata('resStatus','1');
                                    $this->session->set_flashdata('resStatusText','เรียบร้อย');
                                    redirect(base_url('history?lineID='.$line_id));
                                }        
                                else {
                                    $this->session->set_flashdata('resStatus','2');
                                    $this->session->set_flashdata('resStatusText','อัพโหลดข้อมูลไม่สำเร็จ<br>กรุณาลองใหม่');
                                    redirect(base_url('Spa_Cleaning?lineID='.$line_id));
                                } 
                            }
                            else {
                                $this->session->set_flashdata('resStatus','2');
                                $this->session->set_flashdata('resStatusText','อัพโหลดข้อมูลไม่สำเร็จ<br>กรุณาลองใหม่');
                                redirect(base_url('Spa_Cleaning?lineID='.$line_id));
                            }
                        } 
                        else {
                            $this->session->set_flashdata('resStatus','2');
                            $this->session->set_flashdata('resStatusText','อัพโหลดข้อมูลไม่สำเร็จ<br>กรุณาลองใหม่');
                            redirect(base_url('Spa_Cleaning?lineID='.$line_id));
                        }
                    }
                    else {
                        $this->session->set_flashdata('resStatus','2');
                        $this->session->set_flashdata('resStatusText','อัพโหลดข้อมูลไม่สำเร็จ<br>กรุณาลองใหม่');
                        redirect(base_url('Spa_Cleaning?lineID='.$line_id));
                    }
                }
                else {
                    $this->session->set_flashdata('resStatus','1');
                    $this->session->set_flashdata('resStatusText','อัพโหลดข้อมูลไม่สำเร็จ<br>กรุณาลองใหม่');
                    redirect(base_url('Spa_Cleaning?lineID='.$line_id));
                }
            }
            else {
                $this->session->set_flashdata('resStatus','1');
                $this->session->set_flashdata('resStatusText','อัพโหลดข้อมูลไม่สำเร็จ<br>กรุณาลองใหม่');
                redirect(base_url('Spa_Cleaning?lineID='.$line_id));
            }
        }
        else {
            header("location: https://access.line.me/oauth2/v2.1/authorize?app_id=1656240710-mdXq0rXl&client_id=1656240710&scope=chat_message.write+openid+profile&state=mjV2YY5jYOTQ&response_type=code&code_challenge_method=S256&code_challenge=Iyvb9A0hmAjbNWa7sc7kFAJcklkeI5IZiN6E8NB6Oos&liff_sdk_version=2.9.0&type=L&redirect_uri=https%3A%2F%2Fonelth.com%2Fplatform%2Fyesiam%2Fservice&bot_prompt=normal");
        }
    }
}