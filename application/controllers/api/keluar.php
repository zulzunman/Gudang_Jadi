<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './application/libraries/RestController.php';

require './vendor/chriskacerguis/codeigniter-restserver/src/Format.php';

use chriskacerguis\RestServer\RestController;

class Keluar extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('keluar_m','keluar');
        $this->methods['index_get']['limit'] = 10;
        $this->methods['index_post']['limit'] = 10;
        $this->methods['index_delete']['limit'] = 10;
    }

    public function index_get(){
        $id = $this->get('id_keluar');
        if($id === null){
            $keluar = $this->keluar->read();
        } else {
            $keluar = $this->keluar->read_by($id);
        }

        if($keluar){
            $this->response([
                'status' => true,
                'message' => $keluar
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
        $id = $this->delete('id_keluar');

        if($id === null){
            $this->response([
                'status' => false,
                'message' => 'provide an id!'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if($this->keluar->delete($id) > 0){
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
            'id_keluar'			    =>$this->post('id_keluar'),
            'kode_keluar'			=>$this->post('kode_keluar'),
            'jumlah_keluar'			=>$this->post('jumlah_keluar'),
            'id_stok'			    =>$this->post('id_stok')
        ];

        if($this->keluar->create_new($data) > 0){
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
