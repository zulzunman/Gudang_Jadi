<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './application/libraries/RestController.php';

require './vendor/chriskacerguis/codeigniter-restserver/src/Format.php';

use chriskacerguis\RestServer\RestController;

class Masuk extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('masuk_m','masuk');
        $this->methods['index_get']['limit'] = 10;
        $this->methods['index_post']['limit'] = 10;
        $this->methods['index_delete']['limit'] = 10;
    }

    public function index_get(){
        $id = $this->get('id_masuk');
        if($id === null){
            $masuk = $this->masuk->read_all();
        } else {
            $masuk = $this->masuk->read_by($id);
        }

        if($masuk){
            $this->response([
                'status' => true,
                'message' => $masuk
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
        $id = $this->delete('id_masuk');

        if($id === null){
            $this->response([
                'status' => false,
                'message' => 'provide an id!'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if($this->masuk->delete($id) > 0){
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
            'id_masuk'			    =>$this->post('id_masuk'),
            'kode_masuk'				=>$this->post('kode_masuk'),
            'jumlah_masuk'			=>$this->post('jumlah_masuk'),
            'id_stok'			=>$this->post('id_stok')
        ];

        if($this->masuk->create_new($data) > 0){
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
