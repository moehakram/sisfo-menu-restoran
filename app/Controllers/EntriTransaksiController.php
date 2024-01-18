<?php

namespace App\Controllers;

use App\Core\Database\Database;
use App\Core\MVC\{Controller, View};
use App\Models\TranxBayarOrderRequest;
use App\Repository\OrderRepository;
use App\Service\CustomerService;
use App\Service\EntriTransaksiService;

class EntriTransaksiController extends Controller {

    public function index() {
        $orderan = new OrderRepository(Database::getConnection());
        
        $html = View::renderView('admin/entri-transaksi', [
            "title" => "Entri Referensi",
            "user" => [
                "name" => $this->user->name
            ],
            "tx_belumBayar" => $orderan->getByStatus(2),
            "tx_terdahulu" => $orderan->getByStatus(1)
        ]);
        $this->response->setContent($html);
    }

    public function search(){
        $orderan = new OrderRepository(Database::getConnection());
        $keysearch = $this->request->post('keyword');
        $data = ($keysearch == "") ? $orderan->getByStatus(2) : $orderan->getByKey($keysearch);
        $html = View::renderView('admin/entri-transaksi', [
            "title" => "Entri Referensi",
            "user" => [
                "name" => $this->user->name
            ],
            "tx_belumBayar" => $data,
            "tx_terdahulu" => $orderan->getByStatus(1)
        ]);
        $this->response->setContent($html);
    }

    public function finalcheckout() {
        $idorder = (int)$this->request->get('id');
        $html = View::renderView('admin/final-checkout', [
            "title" => "transaksi-bayar",
            "user" => [
                "name" => $this->user->name
            ]
        ] + (new CustomerService())->getCheckout($idorder));
        $this->response->setContent($html);
    }
    
    public function bayarOrder(){
        $request = new TranxBayarOrderRequest();
        $request->id = $this->request->post('idorder');
        $request->idAdmin = $this->user->id;
        $request->idStatus = 1;
        $request->namaAdmin = $this->user->name;
        $request->uangBayar = $this->request->post('uang_bayar');
        $request->uangKembali = $this->request->post('uang_kembali');      
        $request->noMeja = $this->request->post('noMeja');   

        $service = new EntriTransaksiService();
        $service->editOrder($request);
    }

    public function hapusOrder(){
        
        $service = new EntriTransaksiService();
        $request = [
            'idOrder' =>  $this->request->post('id'),
            'noMeja' =>  $this->request->post('noMeja')
        ];
        $response = $service->hapusOrder($request);
        
        $this->response->setContent($response)->JSON();
    }


    public function statusSelesai(){
        $response = new OrderRepository(Database::getConnection());
        $response->updateStatus($this->request->post('id'));
        if($response){
            $this->response->setContent(["success" => "Data berhasil dihapus"])->JSON();
        }else{
            $this->response->setContent(["error" => "Data gagal dihapus"])->JSON();
        }
    }
    
    public function viewInvoice(){ 
        $idorder = $this->request->get('id');
        $html = View::renderViewOnly('print-invoice', (new CustomerService())->getCheckout($idorder, 1));
        $this->response->setContent($html);
    }


}