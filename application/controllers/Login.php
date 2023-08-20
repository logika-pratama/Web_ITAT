<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url');
		$this->load->helper('tgl_indo');
		$this->load->helper('login');
		$this->load->library('user_agent');
		$this->load->helper('form');
		$this->load->library('form_validation');

		if(!empty($this->session->userdata('token'))){
			redirect('index.php/dashboard');
		}

	}

	public function index()
	{
		$data = array(
			'title' => 'Dashboard',
		);
		$this->load->view('login',$data);
	}

	function login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		// $curl = curl_init();
		// curl_setopt_array($curl, array(
		// CURLOPT_URL => 'http://10.230.200.157:8080/api/v1/login',
		// CURLOPT_RETURNTRANSFER => true,
		// CURLOPT_ENCODING => '',
		// CURLOPT_MAXREDIRS => 10,
		// CURLOPT_TIMEOUT => 0,
		// CURLOPT_SSL_VERIFYHOST => false,
		// CURLOPT_FOLLOWLOCATION => true,
		// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		// CURLOPT_CUSTOMREQUEST => 'POST',
		// CURLOPT_POSTFIELDS =>'{
		// 	"email":"'.$email.'",
		// 	"password":"'.$password.'"
		// }',
		// CURLOPT_HTTPHEADER => array(
		// 	'Content-Language: en-US',
		// 	'Content-Type: application/json'
		// ),
		// ));
		// $response = curl_exec($curl);
		// $rss = json_decode($response,true);
		// curl_close($curl);

		// BYPASS LOGIN
		$rss['jwtTokken'] = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoic3JpIG11cm5pIiwiaWRfdXNlciI6IjMzIiwiaWRhY2NvdW50IjoiMDAwOSIsInJvbGUiOiIzIiwiRGV2aWNlX0lEIjoiMDAwN2I2IiwibW9kdWxfbmFtZSI6IldJTTIiLCJpYXQiOjE2ODc4Mzg1NzMsImV4cCI6MTY4NzkyNDk3M30.K4Q7CgeaYNtlKmeKgr66zRZfKE3NMwLb1qEtFRFjqzA";


		if(!empty($rss['jwtTokken'])){	
		$token = array(
				'token' => $rss['jwtTokken'],
				'logged_in' => TRUE,
			);

			if($email == 'sri.murni66@polri.go.id'){
				$token['role'] = 'superadmin';
			}
			$this->session->set_userdata($token);

			echo json_encode(array('status' => true));
		} else {
			echo json_encode(array('status' => false,'massage' => 'Password anda salah!'));
			die;
		}
	}

		function logout(){
			$this->session->sess_destroy();
			$this->session->set_flashdata('msg', '<div class="alert alert-success"><p>Anda Berhasil Logout</p></div>');
			redirect('index.php/login');
		}

	
}
