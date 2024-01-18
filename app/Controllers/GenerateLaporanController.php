<?php

namespace App\Controllers;
use App\Core\MVC\{Controller, View};

class GenerateLaporanController extends Controller {
    private $entrimodel;

    public function __construct(){
        parent::__construct();
        $this->entrimodel = $this->model('GenerateLaporanModel');
    }
    public function index() {
        $data = $this->entrimodel->showData($this->user->name);
        $html = View::renderView('admin/generate-laporan', $data);
        // $this->response->setHeader('Content-Type: application/json; charset=UTF-8');
        $this->response->setContent($html);
    }
    public function printLaporan() {
        $data = $this->entrimodel->showData($this->user->name);
        $html = View::renderViewOnly('admin/print-laporan', $data);
        // $this->response->setHeader('Content-Type: application/json; charset=UTF-8');
        $this->response->setContent($html);
    }

}