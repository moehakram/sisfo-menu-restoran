<?php
namespace App\Controllers;

use App\Core\Database\Database;
use App\Core\MVC\{Controller, View};
use App\Repository\{MenuRepository, MejaRepository};
use App\Service\PesananService;
use App\Service\OrderanService;
use App\Exception\ValidationException;
use App\Domain\Menu;

class PesananController extends Controller{

    private PesananService $pesananService;
    private MenuRepository $menuRepository;

    public function __construct()
    {
        parent::__construct();
        $connection = Database::getConnection();
        $this->menuRepository = new MenuRepository($connection);
        $this->pesananService = new PesananService($this->menuRepository);
    }

    public function index() {
        $dataMakanan = $this->menuRepository->getMenuByJenis('Makanan');
        $dataMinuman = $this->menuRepository->getMenuByJenis('Minuman');
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

    public function pesanMenu()
    {
        $dataMakanan = $this->menuRepository->getMenuByJenis('Makanan');
        $dataMinuman = $this->menuRepository->getMenuByJenis('Minuman');
        $html = View::renderView('pelanggan/pesan-menu', [
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
        $model = $this->menuRepository->getMenuById($this->request->post('id'));
        $this->response->setContent(json_encode($model));
    }
    
    public function meja()
    {
        $model = (new MejaRepository(Database::getConnection()))->getAllMeja();
        $this->response->setContent(json_encode($model));
    }
    
    public function postCheckout() {
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

        if ($orderanService->hasOrderedBefore($orderRequest->idPengunjung)) {
            $this->response->setContent(json_encode(['error' => 'Maaf, Anda sudah memesan sebelumnya.']));
        }

        $orderanResponse = $orderanService->create($orderRequest);
        
        $pesananService = new PesananService();
        foreach ($pesananRequestList as $dataPesanan) {
            $pesanan = $pesananService->create($orderanResponse->id, $dataPesanan);
            $this->pesananRepository->save($pesanan);
        }
        
        $this->response->setContent(json_encode(['orderId' => $orderanResponse->id]));
    }

}