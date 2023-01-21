<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan_model extends CI_Model
{

    public function create()
    {
        $data = array (
            'id_penerimaan'	=> $this->input->post('id_penerimaan'),
            'id_barang'		=> $this->input->post('id_barang'),
            'stok_diterima' => $this->input->post('stok_diterima'),
            'satuan_stok'   => $this->input->post('satuan_stok'),
        );
        $this->db->insert('penerimaan',$data);
    }

    public function read($limit,$start,$keyword = null)
    {
		if($keyword) {
			$this->db->like('id_penerimaan',$keyword);
			$this->db->or_like('id_barang',$keyword);
			$this->db->or_like('stok_diterima',$keyword);
			$this->db->or_like('satuan_stok',$keyword);
		}
        $this->db->limit($limit,$start);
        $query=$this->db->get('penerimaan');
        return $query->result();
    }

	public function create_new($data)
    {
        $this->db->insert('penerimaan',$data);
        return $this->db->affected_rows();
    }

    public function join($limit,$start,$keyword = null)
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('penerimaan', 'barang.id_barang = penerimaan.id_barang');
		if($keyword) {
			$this->db->like('id_penerimaan',$keyword);
			$this->db->or_like('id_barang',$keyword);
			$this->db->or_like('stok_diterima',$keyword);
			$this->db->or_like('satuan_stok',$keyword);
		}
        $this->db->limit($limit,$start);
        $query = $this->db->get();
        return $query->result();
    }

}
