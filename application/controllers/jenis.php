<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jenis extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('jenis_model');	
	}
	public function index()
	{
		$data['jen']=$this->jenis_model->read();
		$this->load->view('jenis/list',$data);
	}
	public function add()
	{
		if($this->input->post('Simpan')) {
			$this->jenis_model->create();
			if($this->db->affected_rows() > 0)
			{
				$this->session->set_flashdata('msg','<p style="color:green;">successfully added </p><br>');
			} else {
				$this->session->set_flashdata('msg','<p style="color:red;">failed add </p><br>');
			}
			redirect('jenis');
		}

		$this->load->view('jenis/add');
	}
	public function edit($id)
	{
		if($this->input->post('Simpan')) {
			$this->jenis_model->update($id);
			if($this->db->affected_rows() > 0) {
			  $this->session->set_flashdata('msg','<p style="color:grey">Kategori berhasil diperbarui!</p>');
			} else {
			  $this->session->set_flashdata('msg','<p style="color:red">Kategori gagal diperbarui!</p>');
			}
			redirect('jenis');
		}
		
		$data['je']=$this->jenis_model->read_by($id);
		$this->load->view('jenis/add',$data);
	}
	public function delete($id)
	{
		$this->jenis_model->delete($id);
		if($this->db->affected_rows() > 0) {
		  $this->session->set_flashdata('msg','<p style="color:orange">Kategori berhasil dihapus!</p>');
		} else {
		  $this->session->set_flashdata('msg','<p style="color:red">Kategori gagal dihapus!</p>');
		}
		redirect('jenis');
	}
}
