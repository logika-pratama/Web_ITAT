<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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
		$this->load->view('main',$data);
	}
	
}
