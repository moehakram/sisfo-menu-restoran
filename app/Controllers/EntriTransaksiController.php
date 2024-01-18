<?php

namespace App\Controllers;
use App\Core\MVC\{Controller, View};

class EntriTransaksiController extends Controller {
    private $entrimodel;

    public function __construct(){
        parent::__construct();
        $this->entrimodel = $this->model('EntriTransaksiModel');
    }
    public function index() {
        $data = $this->entrimodel->showData($this->user->name);
        $html = View::renderView('admin/entri-transaksi', $data);
        $this->response->setContent($html);
    }

    public function search(){
        $data = $this->entrimodel->fetchData($this->user->name, $this->request->post('keyword'));
        $html = View::renderView('admin/entri-transaksi', $data);
        $this->response->setContent($html);
    }

    public function finalcheckout() {
        $data = $this->entrimodel->showDataBayar($this->user, $this->request->get('id'));
        $html = View::renderView('admin/final-checkout', $data);
        $this->response->setContent($html);
    }
    
    public function bayarOrder(){
        $this->entrimodel->editorder($this->user, $this->request->post());
    }
    public function hapusOrder(){
        $respon = $this->entrimodel->hapusOrder($this->request->post('id'));
        if($respon){
            echo json_encode(["success" => "Data berhasil dihapus"]);
        }else{
            echo json_encode(["error" => "Data gagal dihapus"]);
        }
    }
    public function statusSelesai(){
        $respon = $this->entrimodel->hapusOrderFix($this->request->post('id'));
        if($respon){
            echo json_encode(["success" => "Data berhasil dihapus"]);
        }else{
            echo json_encode(["error" => "Data gagal dihapus"]);
        }
    }
    
    public function viewInvoice(){
        $data = $this->entrimodel->print($this->request->get('id'));
        $html = View::renderViewOnly('print-invoice', $data);
        $this->response->setContent($html);
    }


}