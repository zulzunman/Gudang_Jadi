<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './application/libraries/RestController.php';

require './vendor/chriskacerguis/codeigniter-restserver/src/Format.php';

use chriskacerguis\RestServer\RestController;

class Penerimaan extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Penerimaan_model','penerimaan');
        $this->methods['index_get']['limit'] = 10;
        $this->methods['index_post']['limit'] = 10;
        $this->methods['index_delete']['limit'] = 10;
    }

    public function index_get(){
        $id = $this->get('id_penerimaan');
        if($id === null){
            $penerimaan = $this->penerimaan->read_all();
        } else {
            $penerimaan = $this->penerimaan->read_by($id);
        }

        if($penerimaan){
            $this->response([
                'status' => true,
                'message' => $penerimaan
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
        $id = $this->delete('id_penerimaan');

        if($id === null){
            $this->response([
                'status' => false,
                'message' => 'provide an id!'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if($this->penerimaan->delete($id) > 0){
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
            'id_penerimaan'			=>$this->post('id_penerimaan'),
            'id_barang'				=>$this->post('id_barang'),
            'stok_diterima'			=>$this->post('stok_diterima'),
            'satuan_stok'			=>$this->post('satuan_stok')
        ];

        if($this->penerimaan->create_new($data) > 0){
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
