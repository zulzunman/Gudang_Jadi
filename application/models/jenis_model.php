<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jenis_model extends CI_Model {

	public function create()
    {
		$data = array (
            'kode_jenis'    => $this->input->post('kode_jenis'),
            'nama_jenis'   => $this->input->post('nama_jenis')    
        );
        $this->db->insert('jenis',$data);
    }
    public function read()
	{
		$query=$this->db->get('jenis');
        return $query->result();
	}
    public function read_by($id)
	{
		$this->db->where('id_jenis',$id);
		$query=$this->db->get('jenis');
		return $query->row();
	}


	public function update($id)
	{
		$data = array (
			'kode_jenis'    => $this->input->post('kode_jenis'),
            'nama_jenis'   => $this->input->post('nama_jenis')    
        );
		$this->db->where('id_jenis',$id);
		$this->db->update('jenis',$data);
	}
    public function delete($id)
	{
		$this->db->where('id_jenis',$id);
		$this->db->delete('jenis');
	}
}
