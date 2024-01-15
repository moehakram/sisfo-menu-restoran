<?php
namespace App\Controllers;

use App\Core\Database\Database;
use App\Core\MVC\{Controller, View};
use App\Repository\{MenuRepository, MejaRepository, OrderRepository};
use App\Service\CustomerService;
use App\Exception\ValidationException;
use App\Domain\Menu;

class EntriOrderanController extends Controller{

    public function index() {
            $menuRepository = new MenuRepository(Database::getConnection());
            $dataMakanan = $menuRepository->getByJenis('Makanan');
            $dataMinuman = $menuRepository->getByJenis('Minuman');
            $dataMeja = (new MejaRepository(Database::getConnection()))->getAll();

            $view = View::renderView('admin/entri-order', [
                "title" => "Entri Order",
                "user" => [
                    "name" => $this->user->name
                ],
                "makanan" => $dataMakanan,
                "minuman" => $dataMinuman,
                "meja" => $dataMeja
            ]);
            $this->response->setContent($view);
    }


    public function getMenu()
    {
        $menuRepository = new MenuRepository(Database::getConnection());
        $dataMenu = $menuRepository->getById($this->request->post('id'));
        $this->response->setContent(json_encode($dataMenu));
    }
    
    public function getMeja()
    {
        // $this->updateMeja(5);
        $dataMeja = (new MejaRepository(Database::getConnection()))->getByStatus();
        $this->response->setContent(json_encode($dataMeja));
    }

    private function updateMeja($nomor)
    {
        $dataMeja = (new MejaRepository(Database::getConnection()));
        $meja = new \App\Domain\Meja();
        $meja->nomor = $nomor;
        $meja->status = 1;
        $dataMeja->update($meja);
    }


    
    public function postCheckout() {

        $orderRequest = $this->model('UserDataOrderRequest');
        $orderRequest->idPengunjung = $this->user->id;
        $orderRequest->waktuPesan = date("Y-m-d H:i:s");
        $orderRequest->noMeja = $this->request->post('no_meja');
        $orderRequest->totalHarga = $this->request->post('total_harga');
        $orderRequest->idStatus = 2;
        $orderRequest->namaPengunjung = $this->user->name;
        
        $pesananRequestList = [];
        foreach($this->request->post('menu_pesan') as $menu){
            $pesananRequest = $this->model('UserDataPesanRequest');
            $pesananRequest->jumlah = $menu['jumlah'];
            $pesananRequest->idStatus = 2;
            $pesananRequest->idMenu = $menu['id'];
            $pesananRequest->subTotal = $menu['subtotal'];
            $pesananRequest->menuNama = $menu['nama'];
            $pesananRequest->menuHarga = $menu['harga'];
            $pesananRequestList[] = $pesananRequest;
        }
        
        
        $customerService = new CustomerService();
        $response = $customerService->create($orderRequest, $pesananRequestList);     
        $this->response->setContent(json_encode(['orderId' => $response->order->id]));
    }

    public function checkout(){
        $customerService = new CustomerService();

        $response = $customerService->getCheckout(["nama" => $this->user->name, "idOrder" =>$this->request->get('id')]);
        $view = View::renderView('admin/checkout', [
            "title" => "Entri Order",
            "user" => [
                "name" => $this->user->name
            ]
        ]+$response);

        $this->response->setContent($view);
    }

}