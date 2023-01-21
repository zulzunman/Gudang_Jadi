<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {
	
	public function read_all()
	{
		$query = $this->db->get('barang');
		return $query->result();
	}

	public function read_by($id)
    {
        $this->db->where('id_barang',$id);
        $query=$this->db->get('barang');
        return $query->row();
    }
	
    public function read($limit,$start, $keyword = null)
    {
		if($keyword) {
			$this->db->like('id_barang',$keyword);
			$this->db->or_like('nama_barang',$keyword);
			$this->db->or_like('jenis_barang',$keyword);
			$this->db->or_like('warna_barang',$keyword);
			$this->db->or_like('stok_barang',$keyword);
			$this->db->or_like('satuan_barang',$keyword);
		}
        $this->db->limit($limit,$start);
        $query=$this->db->get('barang');
        return $query->result();
    }

	public function create()
	{
		$data = array (
            'id_barang'      => $this->input->post('id_barang'),
            'nama_barang'    => $this->input->post('nama_barang'),
            'jenis_barang'   => $this->input->post('jenis_barang'),
            'warna_barang'   => $this->input->post('warna_barang'),
			'stok_barang'    => $this->input->post('stok_barang'),
			'satuan_barang'  => $this->input->post('satuan_barang'),
        );
        $this->db->insert('barang',$data);
	}

    public function create_new($data)
    {
        $this->db->insert('permintaan_barang_mentah',$data);
        return $this->db->affected_rows();
    }

	public function update($id)
    {
        $data = array (
            'id_barang'      => $this->input->post('id_barang'),
            'nama_barang'    => $this->input->post('nama_barang'),
            'jenis_barang'   => $this->input->post('jenis_barang'),
            'warna_barang'   => $this->input->post('warna_barang'),
			'stok_barang'    => $this->input->post('stok_barang'),
			'satuan_barang'  => $this->input->post('satuan_barang'),
        );
        $this->db->where('id_barang',$id);
        $this->db->update('barang',$data);
    }

    public function delete($id)
    {
        // $this->db->where('id_permintaan_barang',$id);
        // $this->db->delete('permintaan_barang_mentah');
        $this->db->delete('barang',['id_barang'=> $id]);
        return $this->db->affected_rows();
    }
}
