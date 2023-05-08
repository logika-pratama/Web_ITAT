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
		$this->load->model('jwt_model','jwt');

		if(!empty($this->session->userdata('token'))){
			redirect('dashboard');
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
		$this->db->where('username',$email);
		$cek_email = $this->db->get('users')->row_array();
		if(empty($cek_email)){
			echo json_encode(array('status' => false,'massage' => 'Akun tidak dikenali!'));
			die;
		}
		if($password == $cek_email['password']){
			$data_session = array(
				'email' => $email,
			);

			$jwtToken = $this->jwt->generateToken($data_session);

			$token = array(
				'token' => $jwtToken,
				'logged_in' => TRUE,
			);

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
			redirect('login');
		}

	
}
