<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stok extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('stok_m');
		$this->load->model('jenis_model');
		$this->load->model('masuk_m');
	}
	public function index()
	{
		$data['set']=$this->stok_m->read();
		$this->load->view('stok/stok',$data);
	}
    public function add()
	{
		if($this->input->post('Simpan')) {
			$this->stok_m->create();
			if($this->db->affected_rows() > 0)
			{
				$this->session->set_flashdata('msg','<p style="color:green;">successfully added </p><br>');
			} else {
				$this->session->set_flashdata('msg','<p style="color:red;">failed add </p><br>');
			}
			redirect('stok');
		}
		$data ['jen'] = $this->jenis_model->read();
		$this->load->view('stok/addstok', $data);
	}
	public function edit($id)
	{
		if($this->input->post('Simpan')) {
			$this->stok_m->update($id);
			if($this->db->affected_rows() > 0) {
			  $this->session->set_flashdata('msg','<p style="color:grey">Kategori berhasil diperbarui!</p>');
			} else {
			  $this->session->set_flashdata('msg','<p style="color:red">Kategori gagal diperbarui!</p>');
			}
			redirect('stok');
		}
		// $data[''] = $this->masuk_m->
		$data ['jen'] = $this->jenis_model->read();
		$data['st']=$this->stok_m->read_by($id);
		$this->load->view('stok/addstok',$data);
	}
	public function delete($id)
	{
		$this->stok_m->delete($id);
		if($this->db->affected_rows() > 0) {
		  $this->session->set_flashdata('msg','<p style="color:orange">Kategori berhasil dihapus!</p>');
		} else {
		  $this->session->set_flashdata('msg','<p style="color:red">Kategori gagal dihapus!</p>');
		}
		redirect('stok');
	}
}