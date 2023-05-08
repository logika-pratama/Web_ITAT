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
		// $this->form_validation->set_rules('email','email','required');
		// $this->form_validation->set_rules('password','Password','required');
		
		// $email = $this->input->post('email');
		// $password = $this->input->post('password');
		$email = 'admin@gmail.com';
		$password = '123456';

		// if($this->form_validation->run() === FALSE ){
			// $this->session->set_flashdata('msg', '<div class="alert alert-danger"><p>Email atau Password tidak boleh Kosong</p></div>');
			// redirect('login');
		// } else {
			$this->db->where('email',$email);
			$this->db->where('status','active');
			$cek_email = $this->db->get('user')->row_array();
			$id = $cek_email['id_user'];
			$role = $cek_email['role'];
			$name = $cek_email['user'];	
			if(empty($cek_email)){
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"><p>email Anda Salah</p></div>');
				redirect('login');
			}
			$cek = password_verify($password,$cek_email['password']) ? true : false;
			if($cek > 0){
				$data_session = array(
					'id' => $id,
					'name' => $name,
					'email' => $email,
					'role' => $role,
				);

				$jwtToken = $this->jwt->generateToken($data_session);

				$token = array(
					'token' => $jwtToken,
					'logged_in' => TRUE,
				);

				$this->session->set_userdata($token);

				echo json_encode(array('status' => true));
			} else {
				echo json_encode(array('status' => false));
			}
		// }
	}

	function logout(){
		$this->session->sess_destroy();
		$this->session->set_flashdata('msg', '<div class="alert alert-success"><p>Anda Berhasil Logout</p></div>');
		redirect('login');
	}

	
}
