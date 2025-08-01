<?php

namespace App\Service;

use App\Core\Database\Database;
use App\Domain\{Order, Pesanan, Meja};
use App\Repository\OrderRepository;
use App\Repository\PesananRepository;
use App\Repository\MejaRepository;
use App\Models\UserDataOrderRequest;
use App\Models\UserDataOrderResponse;


class CustomerService
{
    private OrderRepository $orderRepository;
    private PesananRepository $pesananRepository;

    public function __construct()
    {
        $connection = Database::getConnection();
        $this->orderRepository = new OrderRepository($connection);
        $this->pesananRepository = new PesananRepository($connection);
    }

    public function create(UserDataOrderRequest $orderan, $pesananList): UserDataOrderResponse
    {
        try{            
            Database::beginTransaction();
            $order = new Order();
            $order->idAdmin = $orderan->idAdmin;
            $order->idPengunjung = $orderan->idPengunjung;
            $order->waktuPesan = $orderan->waktuPesan;
            $order->noMeja = $orderan->noMeja;
            $order->totalHarga = $orderan->totalHarga;
            $order->uangBayar = $orderan->uangBayar;
            $order->uangKembali = $orderan->uangKembali;
            $order->idStatus = $orderan->idStatus;
            $order->namaAdmin = $orderan->namaAdmin;
            $order->namaPengunjung = $orderan->namaPengunjung;
            $this->orderRepository->save($order);

            $upmeja = new MejaRepository(Database::getConnection());

            $meja = new Meja();
            $meja->nomor = $order->noMeja;
            $meja->status = 2;
            $upmeja->update($meja);

            
            $newdata = [];
            foreach ($pesananList as $data) {
                $pesanan = new Pesanan();
                $pesanan->idOrder = $order->id;
                $pesanan->jumlah = $data->jumlah;
                $pesanan->idStatus = $data->idStatus;
                $pesanan->idMenu = $data->idMenu;
                $pesanan->subTotal = $data->subTotal;
                $pesanan->menuNama = $data->menuNama;
                $pesanan->menuHarga = $data->menuHarga;
                $this->pesananRepository->save($pesanan);
                
                $newdata[] = $pesanan;
            }

          
            Database::commitTransaction();

            
            $response = new UserDataOrderResponse();
            $response->order = $order;
            $response->pesanan = $newdata;

            return $response;

        }catch (\Exception $exception) {
            Database::rollbackTransaction();
            return $exception;
        }
    }

    public function getCheckout(int $idOrder, int $idstatus = 2){
        $order = $this->orderRepository->getById($idOrder);
        $pesan = $this->pesananRepository->getAllByIdOrder($idOrder, $idstatus);

        return ['order'=> $order, 'pesanan' => $pesan];
    }
}
