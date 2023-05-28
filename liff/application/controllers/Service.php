<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Bangkok');
class Service extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
        $this->load->model('Service_model');
	}

	public function index(){
		$data['allBrand'] = $this->Service_model->allBrand();

		if($this->input->post('insertBtn')){
			$insertData['lineID'] = $this->input->post('insertLineID');
			$insertData['type'] = $this->input->post('insertType');
			$insertData['brand'] = $this->input->post('insertBrand');
			$insertData['subbrand'] = $this->input->post('insertSubbrand');
			$insertData['comment'] = $this->input->post('insertComment');
			$insertData['userID'] = $this->input->post('insertUserID');

			$path = $insertData['lineID'];

            $date_str = date('Ymd');
            $time_str = date('His');
            $date_time = date('Y-m-d H:i:s');  
			
            if (!is_dir("imgUpload/$path/")) {
                mkdir("imgUpload/$path/", 0777, TRUE);
            }
         
            $file_path = 'imgUpload/'.$path."/";
			
            $filename1 = $date_str."_".$time_str."_1";
            $file_upload1 = 'customerGoodsImage1';

			$filename2 = $date_str."_".$time_str."_11";
			$file_upload2 = 'customerGoodsImage2';

            $up1 = $this->set_upload_options($file_path, $filename1, $file_upload1);
            if($up1 == '1') {
				// $imageStr1 = $this->upload->data();
				// $file1 = $file_path.''.$filename1."".$imageStr1["file_ext"];

				$data1 = array('image_metadata' => $this->upload->data());
                $file1 = $file_path.''.$data1['image_metadata']['file_name'];
			}
			
			$up2 = $this->set_upload_options($file_path, $filename2, $file_upload2);
			if($up2 == '1') {
				// $imageStr2 = $this->upload->data();
				// $file2 = $file_path.''.$filename2."".$imageStr2["file_ext"];

				$data2 = array('image_metadata' => $this->upload->data());
                $file2 = $file_path.''.$data2['image_metadata']['file_name'];
			}

			$insertData['today'] = $date_time;
			$insertData['imgOne'] = $file1;
			$insertData['imgTwo'] = $file2;

			$insertData['wsID'] = $this->Service_model->insertWorksheet($insertData);
			$this->Service_model->insertHistory($insertData);

			// LINE Noti
			$type = $insertData['type'];
			if($type == 'bag') { $type = 'กระเป๋า'; }
			elseif($type == 'shoe') { $type = 'shoe'; }
			else { $type = 'อื่นๆ'; }

			$brand = $insertData['brand'];
			$subbrand = $insertData['subbrand'];
			$subbrand = ($subbrand)?$subbrand:"-";
			$comment = $insertData['comment'];

			$lineID = $insertData['lineID'];
			$customer_data = $this->Service_model->checkCust($lineID);

			$customer_name = $customer_data[0]['user_name'];
			$customer_phome = $customer_data[0]['user_phone'];
			$message = "\n🔊 มีลูกค้า !! 😍 😍 👇";
			$message .= "\nคุณ ".$customer_name;
			$message .= "\n☎️ ".$customer_phome;
			$message .= "\nประเภท : ".$type;
			$message .= "\nแบรนด์ : ".$brand;
			$message .= "\nรุ่น : ".$subbrand;
			$message .= "\nอาการ : ".$comment;

			$this->LineNotiSend($message);
			// LINE Noti

			redirect('liff/history');
		}

		$this->load->view('service', $data);
	}

	public function checkCust(){
		$lineID = $_POST['lineID'];
		$checkCust = $this->Service_model->checkCust($lineID);
		echo json_encode($checkCust);
	}

	public function set_upload_options($file_path, $file_name, $file_upload){
        $config['upload_path']   = $file_path;
        $config['allowed_types'] = 'jpeg|jpg|png|gif';
        $config['max_size']      = 0;
        $config['max_width']     = 0;
        $config['file_name'] = $file_name; 

		$this->load->library('upload', $config);
		$imgUP = (!$this->upload->do_upload($file_upload))?'0':'1';
        return $imgUP;
    }

	public function test() {
		$lineID = "Ue188d6c3c666216a50dfd41ce1bbf5d1";
		$customer_data = $this->Service_model->checkCust($lineID);

		$customer_name = $customer_data[0]['user_name'];
		$customer_phome = $customer_data[0]['user_phone'];
		$message = "\n🔊 มีลูกค้ามาาาาาา 😍 😍 👇";
		$message .= "\nคุณ ".$customer_name;
		$message .= "\n☎️ ".$customer_phome;
		$message .= "\nประเภท : "."อื่นๆ";
		$message .= "\nแบรนด์ : "."brand_name"." รุ่น : "."รุ่น";
		$message .= "\nอาการ : ";
		
		$this->LineNotiSend($message);
	}

	public function LineNotiSend($message) {   
		// LINE Token 
		$token = "dPH7Yrt2jQySUj1CKHvoprn7cX1S6TtXxCavkwySxQr";

        $dataSend = array(
			'message' => $message,
		);

		$headers = array(
			'Method: POST',
			'Content-Type: multipart/form-data',
			'Authorization: Bearer '.$token
		);

		$this->curl = curl_init();
		curl_setopt($this->curl, CURLOPT_URL, 'https://notify-api.line.me/api/notify');
		curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $dataSend);
		$response = curl_exec($this->curl);
		curl_close($this->curl);
		// print_r($response);
    }

}
