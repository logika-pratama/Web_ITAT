<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencarian_aset extends CI_Controller {

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
			'title' => 'Pencarian Aset',
		
		);
		$this->load->view('main',$data);
	}
	
	public function getAssets(){
		$filter = (object) $this->input->get('filter');
		$query = '?1=1';
		if (isset($filter->page) && $filter->page != '') {
			$query = $query.'&page='.(string) $filter->page;
		}
		if (isset($filter->perPage) && $filter->perPage != '') {
			$query = $query.'&perPage='.(string) $filter->perPage;
		}

		$curl = curl_init();

		$url = 'https://aset.divtik.polri.go.id/mobile/'.'api/asset/detail'.$query;
		// $url = itamUrl().'api/asset/detail'.$query;
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


	public function getScanAsset() {
		$assetId = $this->input->get('assetId');
		$rss = array();
		
		// Get data
		$asset = $this->getDetailAsset($assetId);
		$assetHistory = $this->getDetailAssetHistory($assetId);

		$isAvailableAtITAM = $asset["data"] != null;

		// Data tidak ditemukan pada ITAM
		if (!$isAvailableAtITAM) {
			$rss = array(
				"meta" => array(
					"code" => 404,
					"status" => "failed",
					"message" => "Data RFID tidak ditemukan"
				)
			);
		} else {
			$rss = array(
				"meta" => array(
					"code" => 200,
					"status" => "success",
					"message" => "data found"
				),
	
				"data" => array(
					"asset" => $asset["data"][0],
					"history" => $assetHistory["data"]
				)
			);
		}

		echo json_encode($rss);
	}

	private function getDetailAsset($assetId) {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://aset.divtik.polri.go.id/mobile/'.'api/asset/detail?asset_id='.$assetId,
		// CURLOPT_URL => itamUrl().'api/asset/detail?asset_id='.$assetId,
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
		$rss = json_decode($response, true);

		return $rss;
	}

	private function getDetailAssetHistory($assetId) {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://aset.divtik.polri.go.id/mobile/'.'api/asset/asset_move?asset_id='.$assetId,
		// CURLOPT_URL => itamUrl().'api/asset/asset_move?asset_id='.$assetId,
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
		$rss = json_decode($response, true);

		return $rss;
	}

}
