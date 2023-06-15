<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scan_rfid extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url');
		$this->load->helper('tgl_indo');
		$this->load->helper('login');
		$this->load->library('user_agent');
		$this->load->helper('form');
		$this->load->library('form_validation');

		if(empty($this->session->userdata('token'))){
			redirect('login');
		}
	}

	public function index()
	{
		
		$data = array(
			'title' => 'Pemindai Data',
		
		);
		$this->load->view('main',$data);
	}
	
	public function scanRFID(){
		$brr = [];
		$x = 0;
		$scan = $this->input->post('scan');
		$kontrak = $this->input->post('kontrak');
		$arr = explode(",", $scan);
		foreach($arr as $a){
			
			$a = str_replace(" ","",$a);
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => 'http://10.230.200.158:8081/api/asset/detail?asset_id='.$a.'&id_kontrak='.$kontrak,
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
			if(!empty($rss->meta)){
				if($rss->meta->message != 'Asset tidak ditemukan'){
					if($rss->meta->status == 'success'){
						$brr[$x]['assets_id'] = $rss->data[0]->asset_id;
						$brr[$x]['location_asset'] = $rss->data[0]->location_asset;
						if(!empty($rss->data[0]->name_asset)){
							$brr[$x]['name_asset'] = $rss->data[0]->name_asset;
						} else {
							$brr[$x]['name_asset'] = '';
						}	
						$x++;
					} 
				}
			}
		}
		$ress = array(
			"data" => $brr
		);
		$ress = json_encode($ress);
		echo $ress;
	}

	public function setRFID($rfid){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://10.230.200.158:8081/api/ujimat/set_view_ujimat?asset_id='.$rfid,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_HTTPHEADER => array(
			'apikey: $pbkdf2-sha512$6000$P4cQYmzN.X8v5bw3xhijtA$PzGUd4dnuuvvEDgwhUsvDafEKu4W4Z5McvDO5nchfAlllfNsbCXBeB5XE/KrbtFEqfM4ymR2IMzGsKWT0vXKFA'
		),
		));

		$response = curl_exec($curl);
		curl_close($curl);

	}

	public function detailRFID($rfid){
		$curl = curl_init();

		$url = 'http://10.230.200.158:8081/api/asset/detail?asset_id='.$rfid;
		curl_setopt_array($curl, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'apikey: $pbkdf2-sha512$6000$P4cQYmzN.X8v5bw3xhijtA$PzGUd4dnuuvvEDgwhUsvDafEKu4W4Z5McvDO5nchfAlllfNsbCXBeB5XE/KrbtFEqfM4ymR2IMzGsKWT0vXKFA'
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$rss = json_decode($response);
		echo json_encode($rss);
	}

	public function historyRFID($rfid){
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://aset.divtik.polri.go.id/api_itam/api/asset/asset_move?asset_id='.$rfid,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'apikey: $pbkdf2-sha512$6000$P4cQYmzN.X8v5bw3xhijtA$PzGUd4dnuuvvEDgwhUsvDafEKu4W4Z5McvDO5nchfAlllfNsbCXBeB5XE/KrbtFEqfM4ymR2IMzGsKWT0vXKFA'
			),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		$rss = json_decode($response);
		if($rss->meta->status == 'success'){
			echo json_encode($rss->data);
		} else {
			echo json_encode($rss);
		}
	}

	public function closeMat(){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://10.230.200.158:8081/api/ujimat/unset_view_ujimat',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_HTTPHEADER => array(
			'apikey: $pbkdf2-sha512$6000$P4cQYmzN.X8v5bw3xhijtA$PzGUd4dnuuvvEDgwhUsvDafEKu4W4Z5McvDO5nchfAlllfNsbCXBeB5XE/KrbtFEqfM4ymR2IMzGsKWT0vXKFA'
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
	}

	public function getKontrak(){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://10.230.200.158:8081/api/kontrak',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'apikey: $pbkdf2-sha512$6000$P4cQYmzN.X8v5bw3xhijtA$PzGUd4dnuuvvEDgwhUsvDafEKu4W4Z5McvDO5nchfAlllfNsbCXBeB5XE/KrbtFEqfM4ymR2IMzGsKWT0vXKFA'
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$rss = json_decode($response,true);
		echo json_encode($rss['data']);
	}
}
