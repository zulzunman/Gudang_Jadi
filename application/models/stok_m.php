<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stok_m extends CI_Model {

	public function create()
    {
		$data = array (
            'kode_stok'    => $this->input->post('kode_stok'),
            'nama_barang'   => $this->input->post('nama_barang'),
            'nama_jenis'    => $this->input->post('nama_jenis'),
            'ukuran'    => $this->input->post('ukuran'),
            'jumlah'    => $this->input->post('jumlah')
            
        );
        $this->db->insert('stok',$data);
    }
	public function read_all()
	{
		$query = $this->db->get('stok');
		return $query->result();
	}

    public function read()
	{
        
		$query=$this->db->get('stok');
        return $query->result();
	}
    public function read_by($id)
	{
		$this->db->where('id_stok',$id);
		$query=$this->db->get('stok');
		return $query->row();
	}


	public function update($id)
	{
		$data = array (
            'kode_stok'    => $this->input->post('kode_stok'),
            'nama_barang'   => $this->input->post('nama_barang'),
            'nama_jenis'    => $this->input->post('nama_jenis'),
            'ukuran'    => $this->input->post('ukuran')
            // 'jumlah'    => $this->input->post('jumlah')
        );
		$this->db->where('id_stok',$id);
		$this->db->update('stok',$data);
	}
    public function delete($id)
	{
		$this->db->where('id_stok',$id);
		$this->db->delete('stok');
	}
}
