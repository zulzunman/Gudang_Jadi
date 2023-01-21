<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengiriman_model extends CI_Model
{

    public function create()
    {
        $data = array (
            'id_pengiriman' 		=> $this->input->post('id_pengiriman'),
            'id_permintaan_barang' 	=> $this->input->post('id_permintaan_barang'),
            'stok_terkirim' 		=> $this->input->post('stok_terkirim'),
            'satuan_stok' 			=> $this->input->post('satuan_stok'),
            
        );
        $this->db->insert('pengiriman',$data); 
    }

    public function read($limit,$start,$keyword = null)
    {
		if($keyword) {
			$this->db->like('id_pengiriman',$keyword);
			$this->db->or_like('stok_terkirim',$keyword);
			$this->db->or_like('satuan_stok',$keyword);
		}
        $this->db->limit($limit,$start);
        $query=$this->db->get('pengiriman');
        return $query->result();
    }

}
