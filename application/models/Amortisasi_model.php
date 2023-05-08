<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amortisasi_model extends CI_Model {

	var $table = 'amortisasi m';
	var $tabel = 'amortisasi';
    var $id = 'id_amortisasi';
	var $column = array(
		"m.id_po", 
		"m.denda", 
		"m.angsuran", 
		"m.nominal_pembayaran", 
	);
	
	var $order = array('m.id_amortisasi' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		    $this->search = '';

	}

	private function _get_datatables_query()
	{
		$this->db->select('*');
		$this->db->join('po','po.id_po = m.id_po','left');
		$this->db->join('penjualan pe','pe.id_penjualan = po.id_penjualan','left');
		$this->db->join('property p','p.id_property = pe.id_property','left');
        $this->db->join('customer c','c.id_customer = pe.id_customer','left');
        $this->db->join('pembayaran pb','m.id_po = pb.id_po','left');
		$this->db->join('lokasi l','p.id_lokasi = l.id_lokasi','left');

		$this->db->from($this->table);
		
		$i = 0;

		$this->db->where('pb.tipe','kredit');

		if(!empty($this->input->post('s1'))){
			$this->db->where('p.id_lokasi',$this->input->post('s1'));
		}

		if(!empty($this->input->post('s2'))){
			$this->db->where('p.jenis_property',$this->input->post('s2'));
		}

		if(!empty($this->input->post('s4'))){
			$this->db->where('',$this->input->post('s4'));
		}

		if(!empty($this->input->post('s5'))){
			$this->db->where('',$this->input->post('s5'));
		}

		foreach ($this->column as $item)
        {
            if($_POST['search']['value'])
            {
                 
                if($i===0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
         
        if(isset($_POST['order']))
        {
            $this->db->order_by($this->column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
		}
		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");

		$this->db->group_by('m.id_amortisasi');

	}

	function get_datatables($token)
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($token)
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($token)
	{
		$this->db->select('m.id_amortisasi,pb.tipe as tipe');	
		$this->db->join('po','po.id_po = m.id_po','left');
		$this->db->join('penjualan pe','pe.id_penjualan = po.id_penjualan','left');
		$this->db->join('property p','p.id_property = pe.id_property','left');
		$this->db->join('pembayaran pb','m.id_po = pb.id_po','left');
		$this->db->join('lokasi l','p.id_lokasi = l.id_lokasi','left');

		$this->db->where('pb.tipe','kredit');

		if(!empty($this->input->post('s1'))){
			$this->db->where('p.id_lokasi',$this->input->post('s1'));
		}

		if(!empty($this->input->post('s2'))){
			$this->db->where('p.jenis_property',$this->input->post('s2'));
		}

		if(!empty($this->input->post('s4'))){
			$this->db->where('',$this->input->post('s4'));
		}

		if(!empty($this->input->post('s5'))){
			$this->db->where('',$this->input->post('s5'));
		}

		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
		$this->db->group_by('m.id_amortisasi');
		$this->db->from($this->table);

		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->select('*');
		$this->db->where($this->id,$id);
		$this->db->from($this->table);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->tabel, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->tabel, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where($this->id, $id);
		$this->db->delete($this->tabel);
	}

	public function get_by_id_view($id)
	{
		$this->db->from($this->table);
		$this->db->where($this->id,$id);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			$results = $query->result();
		}
		return $results;
	}
}
