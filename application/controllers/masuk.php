<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class masuk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('masuk_m');
		$this->load->model('stok_m');
	}
	public function index()
	{
		$data['mas']=$this->masuk_m->join();
		// $data['mas']=$this->masuk_m->read();
		// $data['set']=$this->stok_m->read();
		$this->load->view('masuk/list',$data);
	}
	public function add()
	{
		if($this->input->post('Simpan')) {
			$this->masuk_m->create();
			if($this->db->affected_rows() > 0)
			{
				$this->session->set_flashdata('msg','<p style="color:green;">successfully added </p><br>');
			} else {
				$this->session->set_flashdata('msg','<p style="color:red;">failed add </p><br>');
			}
			redirect('masuk');
		}
		$data['set']=$this->stok_m->read();
		$this->load->view('masuk/add', $data);
	}
	public function edit($id)
	{
		if($this->input->post('Simpan')) {
			$this->masuk_m->update($id);
			if($this->db->affected_rows() > 0) {
			  $this->session->set_flashdata('msg','<p style="color:grey">Kategori berhasil diperbarui!</p>');
			} else {
			  $this->session->set_flashdata('msg','<p style="color:red">Kategori gagal diperbarui!</p>');
			}
			redirect('masuk');
		}
		
		$data['set']=$this->stok_m->read();
		$data['ma']=$this->masuk_m->read_by($id);
		$this->load->view('masuk/add',$data);
	}
	public function delete($id)
	{
		$this->masuk_m->delete($id);
		if($this->db->affected_rows() > 0) {
		  $this->session->set_flashdata('msg','<p style="color:orange">Kategori berhasil dihapus!</p>');
		} else {
		  $this->session->set_flashdata('msg','<p style="color:red">Kategori gagal dihapus!</p>');
		}
		redirect('masuk');
	}
}