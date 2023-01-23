<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './application/libraries/RestController.php';

require './vendor/chriskacerguis/codeigniter-restserver/src/Format.php';

use chriskacerguis\RestServer\RestController;

class Stok extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('stok_m','stok');
        $this->methods['index_get']['limit'] = 10;
    }

    public function index_get(){
        $id = $this->get('id_stok');
        if($id === null){
            $stok = $this->stok->read_all();
        } else {
            $stok = $this->stok->read_by($id);
        }

        if($stok){
            $this->response([
                'status' => true,
                'message' => $stok
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], RestController::HTTP_NOT_FOUND);
        }
    }   
}