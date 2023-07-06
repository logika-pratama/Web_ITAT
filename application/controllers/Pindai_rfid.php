<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pindai_rfid extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url');
		$this->load->helper('tgl_indo');
		$this->load->helper('login');
		$this->load->library('user_agent');
		$this->load->helper('form');
		$this->load->library('form_validation');

		// if(empty($this->session->userdata('token'))){
		// 	redirect('login');
		// }
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
		$arr = explode(",", $scan);
		$arr_gate = array();
		$z = 0;
		foreach($arr as $b){
			$arr_gate[$z]['tag_number'] = $b;
			$z++;
		}

		$baru = $arr_gate;
		$rss = json_encode($baru);
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://10.230.200.157:8080/api/v1/gatescan',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => $rss,
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'Authorization: Bearer '.$this->session->userdata('token')
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		if(empty($baru)){
			$baru = array();
		}
		echo json_encode(array('data' => $baru));
	}

	public function scanQRcode(){
		$brr = [];
		$x = 0;
		$scan = $this->input->post('scan');
		$arr_gate = array();
		$z = 0;
		$arr_gate[0]['tag_number'] = $scan;

		$baru = $arr_gate;
		$rss = json_encode($baru);
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://10.230.200.157:8080/api/v1/gatescan',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => $rss,
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'Authorization: Bearer '.$this->session->userdata('token')
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		if(empty($baru)){
			$baru = array();
		}
		echo json_encode(array('data' => $baru));
	}

	public function setRFID($rfid){
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => itamUrl().'api/ujimat/set_view_ujimat?asset_id='.$rfid,
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

		$url = itamUrl().'api/asset/detail?asset_id='.$rfid;
		
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
		CURLOPT_URL => itamUrl().'api/ujimat/unset_view_ujimat',
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
		CURLOPT_URL => itamUrl().'api/kontrak',
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
