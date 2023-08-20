<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujimat extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url');
		// if(empty($this->session->userdata('token'))){
		// 	redirect('login');
		// }
	}

	public function index()
	{
		
		$data = array(
			'title' => 'Pemindai Data',
		
		);
		$this->load->view('ujimat',$data);
	}
	
	public function scanRFID(){
		$scan = $this->input->post('scan');
		$kontrak = $this->input->post('kontrak');
		$arr = explode(",", $scan);

		$z = 0;
		foreach($arr as $b){
			$arr_gate[$z]['rfid_code'] = $b;
			$z++;
		}

		$baru = $arr_gate;
		$rss = json_encode($baru);

		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => itamUrl().'api/asset/detail_gate_rfid?id_kontrak='.$kontrak,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_POSTFIELDS =>$rss,
		CURLOPT_HTTPHEADER => array(
			'apikey: $pbkdf2-sha512$6000$GMP4/39PSak1ZsyZs1aqVQ$a60XBBB.7SIq0rjWhdoR8vc27x526lcHngEN./Ou2kO2mJaHKww7abLzqvRRZZfaAu/3IXlxq5hOi71F2rStYA',
			'Content-Type: application/json'
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$data = json_decode($response,true);
		
		if(empty($data)){
			$data = array();
		} else {
			$data = $data['data'];
		}
		$ress = array(
			"data" => $data
		);

		$ress = json_encode($ress);
		echo $ress;
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
		return $response;
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

	public function addKontrak($id){
		$rss = $this->input->post('rss');
		$rss = json_decode($rss,true);
		$kontrak = '';
		foreach($rss as $r){
			if($r['id'] == $id){
				$kontrak = $r;
			}
		}

		$this->db->truncate('ujimat');

		$kontrak = json_encode($kontrak);
		$data = array(
			'status' => 0,
			'response' => $kontrak,
			'status_ujimat' => 1,
		);
		$this->db->update('kontrak',$data);
	}

	public function addItem($rfid,$status){
		if($status == 1){
			$rss = $this->setRFID($rfid);
			$data = array(
				'rfid' => $rfid,
				'rss' => $rss,
			);
			$this->db->insert('ujimat',$data);
		
		} else {
			$this->db->where('rfid',$rfid);
			$this->db->delete('ujimat');
		}

		
		$data = array(
			'status_ujimat' => 0,
		);
		$this->db->update('kontrak',$data);
	}
}
