<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './application/libraries/RestController.php';

require './vendor/chriskacerguis/codeigniter-restserver/src/Format.php';

use chriskacerguis\RestServer\RestController;

class Permintaan_barang_mentah extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Permintaan_barang_mentah_model','permintaan_barang_mentah');
        $this->methods['index_get']['limit'] = 10;
        $this->methods['index_post']['limit'] = 10;
        $this->methods['index_delete']['limit'] = 10;
    }

    public function index_get(){
        $id = $this->get('id_permintaan_barang');
        if($id === null){
            $permintaan_barang_mentah = $this->permintaan_barang_mentah->read_all();
        } else {
            $permintaan_barang_mentah = $this->permintaan_barang_mentah->read_by($id);
        }

        if($permintaan_barang_mentah){
            $this->response([
                'status' => true,
                'message' => $permintaan_barang_mentah
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
        $id = $this->delete('id_permintaan_barang');

        if($id === null){
            $this->response([
                'status' => false,
                'message' => 'provide an id!'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if($this->permintaan_barang_mentah->delete($id) > 0){
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
            'id_permintaan_barang'	=>$this->post('id_permintaan_barang'),
            'id_barang'				=>$this->post('id_barang'),
            'stok_barang'			=>$this->post('stok_barang'),
            'satuan_barang'			=>$this->post('satuan_barang')
        ];

        if($this->permintaan_barang_mentah->create_new($data) > 0){
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
