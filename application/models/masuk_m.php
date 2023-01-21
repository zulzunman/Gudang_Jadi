<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class masuk_m extends CI_Model {

	public function create_new($data)
    {
        $this->db->insert('barang_masuk',$data);
        return $this->db->affected_rows();
    }
	
	public function create()
    {
		$data = array (
            'kode_masuk'    => $this->input->post('kode_masuk'),
            'id_stok'   => $this->input->post('id_stok'),
            'jumlah_masuk'   => $this->input->post('jumlah_masuk')    
        );
		// var_dump($data);
		// exit;
        $this->db->insert('barang_masuk',$data);
		
		$this->db->where('id_stok',$data['id_stok']);
		$query=$this->db->get('stok');
		$datat=$query->row();
		$jumlah=$datat->jumlah+$data['jumlah_masuk'];
		
		// var_dump($query->row());
		// exit;
		
		$this->db->where('id_stok',$data['id_stok']);
		$this->db->update('stok',['jumlah'=>$jumlah]);
    }
	public function join()
    {
        $this->db->select('*');
        $this->db->from('stok as b');
        $this->db->join('barang_masuk as a', 'b.id_stok = a.id_stok');
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
		$query=$this->db->get('barang_masuk');
		$this->db->select('nama_barang');		
		$this->db->from('stok as a');
		$this->db->join('barang_masuk as b', 'a.id_stok = b.id_stok');
		$query = $this->db->get('stok');
        return $query->result();
	}
    public function read_by($id)
	{
		$this->db->where('id_masuk',$id);
		$query=$this->db->get('barang_masuk');
		return $query->row();
	}


	public function update($id)
	{
		$data = array (
			'kode_masuk'    => $this->input->post('kode_masuk'),
            'id_stok'   => $this->input->post('id_stok'),
            'jumlah_masuk'   => $this->input->post('jumlah_masuk')    
        );
		$this->db->where('id_masuk',$id);
		$this->db->update('barang_masuk',$data);

		$this->db->where('id_stok',$data['id_stok']);
		$query=$this->db->get('stok');
		$datat=$query->row();
		$jumlah=$datat->jumlah+$data['jumlah_masuk'];
		
		// var_dump($query->row());
		// exit;
		
		$this->db->where('id_stok',$data['id_stok']);
		$this->db->update('stok',['jumlah'=>$jumlah]);
	}
    public function delete($id)
	{
		$this->db->where('id_masuk',$id);
		$this->db->delete('barang_masuk');
	}
	// public function msk()
	// {
	// 		$data=$this->db
    //         ->select_sum('jumlah_masuk')
    //         ->from('barang_masuk')
    //         ->where('id_stok')
    //         ->get();

	// 		$dataPinjam =  $data->result_array();
	// 		$dataPinjam = $dataPinjam[0]['jumlah_masuk'];
	// 		$totalPinjam = $dataPinjam;

	// 		$result = [
	// 			'totalPinjam' => $totalPinjam,
	// 		];
			
	// 		return $result;
	// }
}
