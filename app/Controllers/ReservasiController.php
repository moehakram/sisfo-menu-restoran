<?php

namespace App\Controllers;

use App\Core\MVC\{Controller, View};

class ReservasiController extends Controller {
    private $entrimodel;

    public function __construct(){
        parent::__construct();
        $this->entrimodel = $this->model('ReservasiModel');
    }
    public function index() {
        $data = $this->entrimodel->showData($this->user->name);
        $html = View::renderView('pelanggan/index', $data);
        $this->response->setContent($html);
    }

    public function pesanMenu()
    {
        $data = $this->entrimodel->showData($this->user->name);
        $html = View::renderView('pelanggan/pesan-menu', $data);
        $this->response->setContent($html);
    }   
    
    
    public function getData()
    {
        $model = $this->entrimodel->getMenuById($this->request->post('id'));
        $this->response->setContent(json_encode($model));
    }

    public function meja()
    {
        $model = $this->entrimodel->getMeja();
        $this->response->setContent(json_encode($model));
    }
    

    public function postCheckout() {
        $data = $this->request->post();
        if ($this->entrimodel->hasOrderedBefore($this->user->id)) {
            $this->response->setContent(json_encode(['error' => 'Maaf, Anda sudah memesan sebelumnya.']));
            return;
        }

        $dataOrder = [
            'idadmin' =>null,
            'idpengunjung' =>$this->user->id,
            'no_meja' => $data["no_meja"], 
            'total_harga' => $data['total_harga'],
            'uang_bayar' => null,
            'uang_kembali' => null,
            'idstatus' => 2,
            ':nama_admin' => null,
            ':nama_pengunjung' => null
        ];

        $dataPesanan = [
            'idorder' => null,
            'iduser' => $this->user->id,
            'menu_pesan' => $data['menu_pesan'],
            'idstatus' => 2
        ];
        $idOrder = $this->entrimodel->save($dataOrder, $dataPesanan);
        $this->response->setContent(json_encode(["orderId" => $idOrder]));
    }

    public function checkout(){
        $model = $this->entrimodel->checkout(["nama" => $this->user->name, "idOrder" =>$this->request->get('id')]);
        $view = View::renderView('pelanggan/checkout', $model);
        $this->response->setContent($view);
        unset($_SESSION['no_meja']);
    }

    public function bookingMeja(){
        $model = $this->entrimodel->booking(["nama" => $this->user->name, "idOrder" =>$this->request->get('id')]);
        $view = View::renderView('pelanggan/checkout', $model);
        $this->response->setContent($view);
        unset($_SESSION['no_meja']);
    }

}