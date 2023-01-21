<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './application/libraries/RestController.php';

require './vendor/chriskacerguis/codeigniter-restserver/src/Format.php';

use chriskacerguis\RestServer\RestController;

class Barang extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Barang_model','barang');
        $this->methods['index_get']['limit'] = 10;
        $this->methods['index_post']['limit'] = 10;
        $this->methods['index_delete']['limit'] = 10;
    }

    public function index_get(){
        $id = $this->get('id_barang');
        if($id === null){
            $barang = $this->barang->read_all();
        } else {
            $barang = $this->barang->read_by($id);
        }

        if($barang){
            $this->response([
                'status' => true,
                'message' => $barang
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id_barang');

        if($id === null){
            $this->response([
                'status' => false,
                'message' => 'provide an id!'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if($this->barang->delete($id) > 0){
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'deleted'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id not found!'
                ], RestController::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'id_barang'			=>$this->post('id_barang'),
            'nama_barang'		=>$this->post('nama_barang'),
            'jenis_barang'		=>$this->post('jenis_barang'),
            'warna_barang'		=>$this->post('warna_barang'),
            'stok_barang'		=>$this->post('stok_barang'),
            'satuan_barang'		=>$this->post('satuan_barang')
        ];

        if($this->barang->create_new($data) > 0){
            $this->response([
                'status' => true,
                'message' => 'add new data success!'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'add new data failed!'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

}
