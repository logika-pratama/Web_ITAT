<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generate extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url');
		$this->load->helper('tgl_indo');
		$this->load->helper('login');
		$this->load->library('user_agent');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	
	public function genLog(){
		$items = $this->db->get('items')->result_array();
		
		foreach($items as $i){
			$tag = $i['tag_number'];
			$this->db->where('tag_number',$tag);
			$check = $this->db->get('log_tag_number')->num_rows();
			$x = 1;
			if($check == 0){
				$x++;
				// $data = array(
				// 	'tag_number' => $tag,
				// 	'flag' => 2,
				// 	'is_alarm' => true,
				// 	'created_at' => date('Y-m-d H:i:s'),
				// 	'updated_at' => date('Y-m-d H:i:s'),
				// );
				// $this->db->insert('log_tag_number');
			}
			var_dump($x); die;
		}
	}

}
