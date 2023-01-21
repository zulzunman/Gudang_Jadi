<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang_model extends CI_Model {
	
	public function read_by()
	{
		$this->db->select('*');
		$this->db->from('barang');
		$query = $this->db->get();
		return $query->result();
	}
	public function read()
	{
		$this->db->select('*');
		$this->db->from('gudang');
		$this->db->join('barang','barang.id_barang = gudang.id_barang');
		$query = $this->db->get();
		return $query->result();
	}
	public function create()
	{
		$data = array (
            'id_barang'      => $this->input->post('id_barang'),
            'nama_barang'    => $this->input->post('nama_barang'),
            'stok_barang'    => $this->input->post('stok_barang'),
            'satuan_stok'    => $this->input->post('satuan_stok'),
        );
        $this->db->insert('gudang',$data);
	}

}
