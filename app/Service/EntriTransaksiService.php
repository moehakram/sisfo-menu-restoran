<?php
namespace App\Service;

use App\Core\Database\Database;
use App\Domain\Meja;
use App\Domain\Order;
use App\Models\TranxBayarOrderRequest;
use App\Repository\MejaRepository;
use App\Repository\OrderRepository;
use App\Repository\PesananRepository;

class EntriTransaksiService{
    private PesananRepository $pesananRepository;
    private OrderRepository $orderRepository;
    private MejaRepository $mejaRepository;

    public function __construct()
    {
        $connection = Database::getConnection();
        $this->pesananRepository = new PesananRepository($connection);
        $this->orderRepository = new OrderRepository($connection);
        $this->mejaRepository = new MejaRepository($connection);
        
    }

    public function editOrder(TranxBayarOrderRequest $request) {
        try {
            Database::beginTransaction();

            $data = new Order();
            $data->id = $request->id;
            $data->idAdmin = $request->idAdmin;
            $data->idStatus = $request->idStatus;
            $data->namaAdmin = $request->namaAdmin;
            $data->uangBayar = $request->uangBayar;
            $data->uangKembali = $request->uangKembali;
            $data->noMeja = $request->noMeja;

            $this->orderRepository->updateTranx($data);
            $meja = new Meja;
            $meja->nomor = $data->noMeja;
            $meja->status = 1;

            $this->mejaRepository->update($meja);

            $this->pesananRepository->updateStatusPesanan($data->id);

            Database::commitTransaction();
        } catch (\PDOException $e) {
            Database::rollbackTransaction();
        }  
    }

    public function hapusOrder($data) {
        try {
            Database::beginTransaction();
            $this->orderRepository->delete($data['idOrder']);

            $meja = new Meja;
            $meja->nomor = $data['noMeja'];
            $meja->status = 1;

            $this->mejaRepository->update($meja);
            
            Database::commitTransaction();
            return ["success" => "Data berhasil dihapus"];
        } catch (\PDOException $e) {
            Database::rollbackTransaction();
            return ["error" => "Data gagal dihapus"];
        }
    }
}