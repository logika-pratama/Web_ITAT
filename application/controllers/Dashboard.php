<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
			'title' => 'Dashboard',
			'session' => $session,
		);
		$this->load->view('template',$data);
	}
	
	public function page_content($token,$bulan = null,$tahun = null)
	{

		$data = array(
			'title' => 'Dashboard',
		);
		$this->load->view('main',$data);
	}

	function logout(){
		$this->session->sess_destroy();
		$this->session->set_flashdata('msg', '<div class="alert alert-success"><p>Anda Berhasil Logout</p></div>');
		redirect('index.php/login');
	}

}
