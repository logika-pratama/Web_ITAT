<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujimat_scanqr extends CI_Controller {

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

	public function index() {
		$data = array(
			'title' => 'Uji Mat (QR Code)',
		
		);
		$this->load->view('main',$data);
	}

	public function getKontrak() {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://itam.digiprimatera.co.id:8081/api/kontrak',
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

		// BYPASS master kontrak
		// $rss = array(
		// 	"meta" => array(
		// 		"code" => 200,
		// 		"status" => "success",
		// 		"message" => "success"
		// 	),
		// 	"data" => array(
		// 		array(
		// 			"id" => 111,
		// 			"name" =>  "SP/78/APBN/II/HUK.11.8./2023/Div TIK",
		// 			"description" => "Pengadaan Perangkat Hyper Converged Infrastruktur Private Cloud untuk Virtual Developer Worksapce Pada Private Cloud T.A. 2023"
		// 		),
		// 		array(
		// 			"id" => 112,
		// 			"name" =>  "SP/78/APBN/II/HUK.11.8./2023/Div TIK II",
		// 			"description" => "Pengadaan Smart Link Coverage program APBN T.A 2017"
		// 		),
		// 		array(
		// 			"id" => 113,
		// 			"name" =>  "SP/78/APBN/II/HUK.11.8./2023/Div TIK III",
		// 			"description" => "PEMBANGUNAN COMMAND CENTER POLDA SULBAR T.A. 2020"
		// 		),
		// 	),
		// 	"total_data" => null
		// );
		// echo json_encode($rss['data']);
	}

	public function getUjiMaterial() {
		$kontrakId = $this->input->get('kontrakId');
		// $kontrakName = $this->input->get('kontrakName');
		$assetId = $this->input->get('assetId');
		$rss = array();
		$isAvailableGateRFID = null;
		$isSkip = false;


		// echo $kontrakId;
		// Get detail gate RFID (cek kontrak id dan asset id)
		if ($kontrakId != -1) {
			// $data = $this->getDetailGateRFID($kontrakId, $assetId);
			// var_dump($data);
			// $isAvailableGateRFID = sizeof($data);
			$isAvailableGateRFID = $this->getDetailGateRFID($kontrakId, $assetId);
			// echo json_encode($rss); 
			if (!$isAvailableGateRFID) {
				// Data tidak ditemukan pada kontak X
				$isSkip = true;
				$rss = array(
					"meta" => array(
						"code" => 404,
						"status" => "failed",
						"message" => "Data tidak ditemukan pada kontrak terkait" 
						// "message" => "Data tidak ditemukan pada kontrak " . $kontrakName 
					),
				);

				// echo json_encode($rss);
				// return;
			}
		}

		
		// Get data
		$asset = $this->getDetailAsset($assetId);
		$assetHistory = $this->getDetailAssetHistory($assetId);
		// $asset = json_decode(json_encode($data), true);
		// $asset = json_encode($asset);
		// $asset = json_decode($asset);
		// echo json_encode($asset["data"]);
		// echo json_encode($asset["data"][0]);
		// echo $asset->data[0];
		

		// $isAvailableAtITAM = $asset["data"]

		$isAvailableAtITAM = $asset["data"] != null && sizeof($assetHistory["data"]) != 0;
		// $isAvailableAtITAM = true;
		// $isAvailableAtITAM = false;
		// curl data detail aset & history


		// Data tidak ditemukan pada ITAM
		if ($kontrakId == -1 && !$isAvailableAtITAM) {
			$rss = array(
				"meta" => array(
					"code" => 404,
					"status" => "failed",
					"message" => "Data tidak ditemukan pada ITAM"
				)
			);
		}

		// Data ditemukan
		if ($isAvailableAtITAM && !$isSkip) {
			// $rss = array(
			// 	"meta" => array(
			// 		"code" => 200,
			// 		"status" => "success",
			// 		"message" => "data found",
			// 		"isAvailableGateRFID" => $isAvailableGateRFID
			// 	),
	
			// 	"data" => array(
			// 		"asset" => array(
			// 			"namaAset" => "Aset 1"
			// 		),
	
			// 		"history" => array(
			// 			array(
			// 				"tahun" => "2022"
			// 			),
			// 			array(
			// 				"tahun" => "2023"
			// 			),
			// 		)
			// 	)
			// );

			$rss = array(
				"meta" => array(
					"code" => 200,
					"status" => "success",
					"message" => "data found",
					"isAvailableGateRFID" => $isAvailableGateRFID
				),
	
				"data" => array(
					"asset" => $asset["data"][0],
					"history" => $assetHistory["data"]
				)
			);
		}


		echo json_encode($rss);
	}

	private function getDetailGateRFID($kontrakId, $assetId) {
		$data = array(
			array(
				"rfid_code" => $assetId,
			)
		);

		$data = json_encode($data);

		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://itam.digiprimatera.co.id:8081/api/asset/detail_gate_rfid?id_kontrak='.$kontrakId,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_POSTFIELDS => $data,
		CURLOPT_HTTPHEADER => array(
				'apikey: $pbkdf2-sha512$6000$P4cQYmzN.X8v5bw3xhijtA$PzGUd4dnuuvvEDgwhUsvDafEKu4W4Z5McvDO5nchfAlllfNsbCXBeB5XE/KrbtFEqfM4ymR2IMzGsKWT0vXKFA'
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$rss = json_decode($response, true);
		// var_dump($rss);
		// echo $rss;

		// return $rss->data->data.length > 0;
		// echo json_encode($rss);
		return sizeof($rss["data"]) > 0;
		// return $rss;

		// BYPASS get detail gate RFID
		// $rss = array(
		// 	"data" => array(
		// 		"data" => array()
		// 		// "data" => array(
		// 		// 	array(
		// 		// 		"serial_number" => "N5NRKD01234518B",
    //     //     "asset_id" => "442520000000000000000007",
    //     //     "name_asset" => "Lap top Asus",
    //     //     "location_asset" => "WHC-A-03-A"
		// 		// 	)
		// 		// )
		// 	)
		// );


		// return sizeof($rss["data"]["data"]) > 0;
		// return $rss["data"]["data"];
	}

	private function getDetailAsset($assetId) {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://itam.digiprimatera.co.id:8081/api/asset/detail?asset_id='.$assetId,
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
		CURLOPT_URL => 'https://aset.divtik.polri.go.id/api_itam/api/asset/asset_move?asset_id='.$assetId,
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
