<?php
namespace App\Controllers;

use App\Core\Database\Database;
use App\Core\MVC\{Controller, View};
use App\Repository\{MenuRepository, MejaRepository};
use App\Service\OrderanService;
use App\Exception\ValidationException;
use App\Domain\Menu;

class CustomerController extends Controller{

    public function index() {
        
        $menuRepository = new MenuRepository(Database::getConnection());

        $dataMakanan = $menuRepository->getByJenis('Makanan');
        $dataMinuman = $menuRepository->getByJenis('Minuman');
        $html = View::renderView('pelanggan/index', [
            "title" => "Entri Order",
            "user" => [
                "name" => $this->user->name
            ],
            "makanan" => $dataMakanan,
            "minuman" => $dataMinuman
        ]);

        $this->response->setContent($html);
    }

    public function getData()
    {
        $model = $this->menuRepository->getById($this->request->post('id'));
        $this->response->setContent(json_encode($model));
    }
    
    public function meja()
    {
        $model = (new MejaRepository(Database::getConnection()))->getAll();
        $this->response->setContent(json_encode($model));
    }
    
    public function postCheckout() {
        $orderRepository = new OrderRepository(Database::getConnection());
        if ($orderRepository->hasOrderedBefore($this->user->id)) {
            $this->response->setContent(json_encode(['error' => 'Maaf, Anda sudah memesan sebelumnya.']));
            return;
        }

        $orderRequest = $this->model('UserDataOrderRequest');
        $orderRequest->idPengunjung = $this->user->id;
        $orderRequest->waktuPesan = date("Y-m-d H:i:s");
        $orderRequest->noMeja = $this->request->post('no_meja');
        $orderRequest->totalHarga = $this->request->post('total_harga');
        $orderRequest->idStatus = 2;

        $pesananRequestList = [];
        foreach($this->request->post('menu_pesan') as $menu){
            $pesananRequest = $this->model('UserDataPesanRequest');
            $pesananRequest->jumlah = $menu['jumlah'];
            $pesananRequest->idstatus = 2;
            $pesananRequest->idMenu = $menu['id'];
            $pesananRequest->subtotal = $menu['subtotal'];
            $pesananRequest->menuNama = $menu['nama'];
            $pesananRequest->menuHarga = $menu['harga'];
            $pesananRequestList[] = $pesananRequest;
        }

        
        $orderanService = new OrderanService();
        $orderanService->create($orderRequest, $pesananRequestList);

        
        $this->response->setContent(json_encode(['orderId' => $orderanResponse->id]));
    }

}