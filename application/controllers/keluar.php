<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class keluar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('keluar_m');
		$this->load->model('masuk_m');
		$this->load->model('stok_m');	
	}
	public function index()
	{
		$data['kel']=$this->keluar_m->join();
		// $data['kel']=$this->keluar_m->read();
		$this->load->view('keluar/list',$data);
	}
	public function add()
	{
		// // $type = $this->session->userdata('usertype');
        // $this->db->where('id_stok',$data['id_stok']);
		// $query=$this->db->get('stok');
		// $datat=$query->row();
		// $jumlah=$datat->jumlah-$data['jumlah_keluar'];
        // $this->masuk_m->read();
		if($this->input->post('Simpan')){
			// $jumlah = 
                // $bukti = $this->Pengeluaran_model->bukti();
                $this->keluar_m->create();
                if($this->db->affected_rows() > 0) { 
                    $this->session->set_flashdata('msg','<p style="color:green">Pengeluaran Berhasil Ditambahkan !</p>');
                } else {
                    $this->session->set_flashdata('msg','<p style="color:red">Pengeluaran Gagal Ditambahkan !</p>');
                }
                redirect('keluar');
        }
		// if($this->input->post('Simpan')) {
		// 	$this->keluar_m->create();
		// 	if($this->db->affected_rows() > 0)
		// 	{
		// 		$this->session->set_flashdata('msg','<p style="color:green;">successfully added </p><br>');
		// 	} else {
		// 		$this->session->set_flashdata('msg','<p style="color:red;">failed add </p><br>');
		// 	}
		// 	redirect('keluar');
		// }

		$data['set']=$this->stok_m->read();
		$this->load->view('keluar/add',$data);
	}
	public function edit($id)
	{
		if($this->input->post('Simpan')) {
			$this->keluar_m->update($id);
			if($this->db->affected_rows() > 0) {
			  $this->session->set_flashdata('msg','<p style="color:grey">Kategori berhasil diperbarui!</p>');
			} else {
			  $this->session->set_flashdata('msg','<p style="color:red">Kategori gagal diperbarui!</p>');
			}
			redirect('keluar');
		}
		
		$data['ke']=$this->keluar_m->read_by($id);
		$this->load->view('keluar/add',$data);
	}
	public function delete($id)
	{
		$this->keluar_m->delete($id);
		if($this->db->affected_rows() > 0) {
		  $this->session->set_flashdata('msg','<p style="color:orange">Kategori berhasil dihapus!</p>');
		} else {
		  $this->session->set_flashdata('msg','<p style="color:red">Kategori gagal dihapus!</p>');
		}
		redirect('keluar');
	}
}