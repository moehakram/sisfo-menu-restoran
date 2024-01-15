<?php
namespace App\Controllers;

use App\Core\MVC\{Controller, View};

class EntriOrderController extends Controller {
    private $entrimodel;

    public function __construct(){
        parent::__construct();
        $this->entrimodel = $this->model('EntriOrderModel');
    }
    public function index() {
        $data = $this->entrimodel->showData($this->user->name);
        $html = View::renderView('admin/entri-order', $data);
        $this->response->setContent($html);
    }
    
    public function getData()
    {
        $model = $this->entrimodel->getMenuById($this->request->post('id'));
        echo json_encode($model);
    }

    public function postCheckout() {
        $data = $this->request->post();
        $dataOrder = [
            'idadmin' =>$this->user->id,
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
        unset($_SESSION['no_meja']);
        echo json_encode(["orderId" => $idOrder]);
    }

    public function checkout(){
        $model = $this->entrimodel->checkout(["nama" => $this->user->name, "idOrder" =>$this->request->get('id')]);
        $view = View::renderView('admin/checkout', $model);
        $this->response->setContent($view);
    }

    public function reservasi(){
        $model = $this->entrimodel->bookingMeja($this->user);
        $view = View::renderView('admin/pesan-meja', $model);
        $this->response->setContent($view);
    }

}