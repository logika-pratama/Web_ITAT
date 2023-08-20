<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_ujimat extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('user_agent');

	}

	public function index()
	{
		$this->load->view('dashboard');
	}

	public function addItem($rfid,$status){
		if($status == 1){
			$rss = $this->setRFID($rfid);
			$data = array(
				'rfid' => $rfid,
				'rss' => $rss,
			);
			$this->db->insert('ujimat',$data);

		} else {
			$this->db->where('rfid',$rfid);
			$this->db->delete('ujimat');
		}

		curl_close($curl);
		$rss = json_decode($response,true);
		echo json_encode($rss['data']);

		$data = array(
			'status_ujimat' => 0,
		);
		$this->db->update('kontrak',$data);
	}

	public function getStatus(){
		$data = $this->db->get('kontrak')->row_array();
		echo json_encode($data);
	}

	public function getUjimat(){
		$this->db->order_by('id','desc');
		$rs = $this->db->get('ujimat')->result_array();
		?>
		 <table style="width:100%;">
			<tr>
				<th>RFID</th>
				<th>Nama Aset</th>
				<th>Detail</th>
			<tr>
		<?php 
		
			foreach($rs as $r){
			$data = json_decode($r['rss'],true);
			$produk = $data['data']['detail'][0]['product_attribute'];
		?>
			<tr>
				<td><?=$r['rfid']?></td>
				<td><?=$data['data']['detail'][0]['name_asset']?></td>
				<td>
					<div class="row">
						<?php 
							foreach($produk as $p){
						?> 
						<div class="col-6"><?=$p['name']?></div>
						<div class="col-6"><?=$p['description']?></div>
						<?php } ?>
					</div>
				</td>
			</tr>
			<?php } ?>
		 </table>
		<?php

	}
	
}
