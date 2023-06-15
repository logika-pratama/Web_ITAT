<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
			'title' => 'Akun Pengguna',
			'users' => $this->db->get('users')->result_array(),
		);
		$this->load->view('main',$data);
	}

	public function tambah(){
		$data = array(
			'id_user' => rand(),
			'name' => $this->input->post('nama'),
			'description' => '',
			'telpon' => '',
			'email' => $this->input->post('email'),
			'username' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'id_account' => '0009',
			'role' => 3,
			'device_id' => '0008b8'
		);
		if(!empty($this->input->post('id_user'))){
			$this->db->where('id_user',$this->input->post('id_user'));
			$this->db->update('users',$data);
		} else {
			$this->db->insert('users',$data);
		}
		redirect(base_url('index.php/users/'));
	}

	public function hapus($id){
		$this->db->where('id_user',$id);
		$this->db->delete('users');
		redirect(base_url('index.php/users/'));
	}
}
