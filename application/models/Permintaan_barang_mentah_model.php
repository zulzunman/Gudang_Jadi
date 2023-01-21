<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan_barang_mentah_model extends CI_Model
{

    public function create()
    {
        $data = array (
            'id_permintaan_barang'	=>$this->input->post('id_permintaan_barang'),
            'id_barang'				=>$this->input->post('id_barang'),
            'stok_barang'			=>$this->input->post('stok_barang'),
            'satuan_barang'			=>$this->input->post('satuan_barang'),
        );
        $this->db->insert('permintaan_barang_mentah',$data);
    }

    public function create_new($data)
    {
        $this->db->insert('permintaan_barang_mentah',$data);
        return $this->db->affected_rows();
    }

    public function join($limit,$start,$keyword = null)
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('permintaan_barang_mentah', 'barang.id_barang = permintaan_barang_mentah.id_barang');
		if($keyword) {
			$this->db->like('id_permintaan_barang',$keyword);
			$this->db->or_like('stok_terkirim',$keyword);
			$this->db->or_like('status',$keyword);
		}
        $this->db->limit($limit,$start);
        $query = $this->db->get();
        return $query->result();
    }

    public function read($limit = null,$start = null)
    {
        if($limit & $start){
            $this->db->limit($limit,$start);
        }
        $query=$this->db->get('permintaan_barang_mentah');
        return $query->result();
    }

    public function read_all()
    {
        // $query = $this->db->get('permintaan_barang_mentah');
        // return $query->result();
        return $this->db->get('permintaan_barang_mentah')->result_array();
    }

    public function read_by($id)
    {
        $this->db->where('id_permintaan_barang',$id);
        $query = $this->db->get('permintaan_barang_mentah');
        return $query->row();
    }

    public function update($id)
    {
        $data = array (
            'status'=>$this->input->post('status')
        );
        $this->db->where('id_permintaan_barang',$id);
        $this->db->update('permintaan_barang_mentah',$data);
    }

    public function delete($id)
    {
        // $this->db->where('id_permintaan_barang',$id);
        // $this->db->delete('permintaan_barang_mentah');
        $this->db->delete('permintaan_barang_mentah',['id_permintaan_barang'=> $id]);
        return $this->db->affected_rows();
    }

}
