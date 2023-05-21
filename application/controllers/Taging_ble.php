<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Taging_ble extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url');
		$this->load->helper('tgl_indo');
		$this->load->helper('login');
		$this->load->library('user_agent');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('jwt_model','jwt');

		if(empty($this->session->userdata('token'))){
			redirect('login');
		}
	}

	public function index()
	{
		$session = $this->jwt->decodeToken($this->session->userdata('token'));
		$data = array(
			'title' => 'Pemindai Data',
			'session' => $session,
		);
		$this->load->view('main',$data);
	}

	public function konfrim(){
		$ble1 = $this->input->post('ble1');
		$ble2 = $this->input->post('ble2');
	
		$ble1 = '1we3';
		$ble2 = '111500000000000000000010';
		
		$name_produk = $this->detailRFID($ble2);
		$payload = '{
			"id": "'.$ble1.'",
			"tag_name": "BTM-0001",
			"assetId": "'.$ble2.'",
			"name": "'.$name_produk.'",
			"object_name": "assetA",
			"object_type": "assets",
			"picture": "/assets/images/ ID-A-0000000000001.png",
			"date": "'.date('Ymd').'",
			"position": {"z":1},
			"duration": {"second": 0}
	  
		}';

		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://10.230.200.156:8000/track_object',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => $payload,
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiT3BlcmF0b3IiLCJpZF91c2VyIjoib3BlcmF0b3ItZ3VkYW5nIiwiaWRhY2NvdW50IjoiMDAwOSIsInJvbGUiOiIzIiwiRGV2aWNlX0lEIjoiMDAwOGI4IiwibW9kdWxfbmFtZSI6IldJTTIiLCJpYXQiOjE2NjQ1MTk1MjMsImV4cCI6MTY2NDYwNTkyM30.7d9iS2vuajHaVJeVOX6yel-1toaWlAf4qlGIsjDBTOM'
		),
		));

		$response = curl_exec($curl);
		var_dump($response); 
		die;

		curl_close($curl);
		
		echo $response;
	}

	public function detailRFID($rfid){
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => 'http://10.230.200.158:8081/api/asset/detail?asset_id='.$rfid,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'apikey: $pbkdf2-sha512$6000$GMP4/39PSak1ZsyZs1aqVQ$a60XBBB.7SIq0rjWhdoR8vc27x526lcHngEN./Ou2kO2mJaHKww7abLzqvRRZZfaAu/3IXlxq5hOi71F2rStYA'
			),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			$rss = json_decode($response);
		
			if($rss->meta->status == 'success'){
				return $rss->data[0]->name_asset;
			} else {
				return '';
			}
	}

	// function detailBLE($ble){
	// 	$curl = curl_init();
	// 	curl_setopt_array($curl, array(
	// 		CURLOPT_URL => 'http://10.230.200.158:8081/api/ble?kode_ble='.$ble,
	// 		CURLOPT_RETURNTRANSFER => true,
	// 		CURLOPT_ENCODING => '',
	// 		CURLOPT_MAXREDIRS => 10,
	// 		CURLOPT_TIMEOUT => 0,
	// 		CURLOPT_FOLLOWLOCATION => true,
	// 		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 		CURLOPT_CUSTOMREQUEST => 'GET',
	// 		CURLOPT_POSTFIELDS =>'[
	// 			{
	// 				"ble_code": "123",
	// 				"status" : "non_active"
	// 			},
	// 			{
	// 				"ble_code": "234",
	// 				"status" : "active"
	// 			}
	// 		]',
	// 		CURLOPT_HTTPHEADER => array(
	// 			'apikey: $pbkdf2-sha512$6000$P4cQYmzN.X8v5bw3xhijtA$PzGUd4dnuuvvEDgwhUsvDafEKu4W4Z5McvDO5nchfAlllfNsbCXBeB5XE/KrbtFEqfM4ymR2IMzGsKWT0vXKFA',
	// 			'Content-Type: application/json'
	// 		),
	// 		));

	// 		$response = curl_exec($curl);

	// 		curl_close($curl);
	// 		$rss = json_decode($response);

	// 		if($rss->meta->status == 'success'){
	// 			return $rss->data[0]->name_asset;
	// 		} else {
	// 			return '';
	// 		}
	// 		var_dump($rss); die;
	// }

}
