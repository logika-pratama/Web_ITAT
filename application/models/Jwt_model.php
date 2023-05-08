<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/CreatorJwt.php';

class Jwt_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->objOfJwt = new CreatorJwt();
		$this->load->database();
	}

	public function generateToken($data_session)
	{
		$jwtToken = $this->objOfJwt->GenerateToken($data_session);
		return $jwtToken;
	}

	public function decodeToken($jwtToken)
	{
		$jwtData = $this->objOfJwt->DecodeToken($jwtToken);
		return $jwtData;
	}



}
