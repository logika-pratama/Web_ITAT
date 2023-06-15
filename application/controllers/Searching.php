<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Searching extends CI_Controller {

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

	public function waiting($id = null){
		$url = $this->input->get('url');
		$this->load->view('loading');
		
		header('Refresh: 1;URL='.$url);
	}
	
}
