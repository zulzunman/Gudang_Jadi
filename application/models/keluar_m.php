<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class keluar_m extends CI_Model {

	public function create()
    {
		$data = array (
            'kode_keluar'    => $this->input->post('kode_keluar'),
            'id_stok'    => $this->input->post('id_stok'),
            'jumlah_keluar'   => $this->input->post('jumlah_keluar')    
        );
        $this->db->where('id_stok',$data['id_stok']);
		$query=$this->db->get('stok');
		$datat=$query->row();
		$jumlah=$datat->jumlah-$data['jumlah_keluar'];
		// $this->form_validation->set_rules('stok',$jumlah, '');
		
		
		if($this->input->post('jumlah_keluar') > $datat->jumlah){
			redirect('keluar/add');
		} else {
			$this->db->insert('barang_keluar',$data);
		}
		
		// var_dump($datat->jumlah);
		// var_dump($data['jumlah_keluar']);
		// exit;
		
		$this->db->where('id_stok',$data['id_stok']);
		$this->db->update('stok',['jumlah'=>$jumlah]);
    }
	public function join()
    {
        $this->db->select('*');
        $this->db->from('stok as b');
        $this->db->join('barang_keluar as a', 'b.id_stok = a.id_stok');
		// if($keyword) {
		// 	$this->db->like('id_permintaan_barang',$keyword);
		// 	$this->db->or_like('stok_terkirim',$keyword);
		// 	$this->db->or_like('status',$keyword);
		// }
        // $this->db->limit($limit,$start);
        $query = $this->db->get();
        return $query->result();
    }
    public function read()
	{
		$query=$this->db->get('barang_keluar');
        return $query->result();
	}
    public function read_by($id)
	{
		$this->db->where('id_keluar',$id);
		$query=$this->db->get('barang_keluar');
		return $query->row();
	}


	public function update($id)
	{
		$data = array (
			'kode_keluar'    => $this->input->post('kode_keluar'),
            'jumlah_keluar'   => $this->input->post('jumlah_keluar')    
        );
		$this->db->where('id_keluar',$id);
		$this->db->update('barang_keluar',$data);
	}
    public function delete($id)
	{
		$this->db->where('id_keluar',$id);
		$this->db->delete('barang_keluar');
	}
}
