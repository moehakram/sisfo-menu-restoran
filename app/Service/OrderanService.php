<?php

namespace App\Service;

use App\Core\Database\Database;
use App\Domain\Menu;
use App\Repository\OrderRepository;
use App\Repository\PesananRepository;
use App\Models\UserDataOrderRequest;
use App\Models\UserDataPesanRequest;
use App\Models\UserDataOrderResponse;


class PesananService
{
    private OrderRepository $orderRepository;
    private PesananRepository $pesananRepository;

    public function __construct()
    {
        $connection = Database::getConnection();
        $this->orderRepository = new OrderRepository($connection);
        $this->pesananRepository = new PesananRepositori($connection);
    }

    public function create(UserDataOrderRequest $orderan, UserDataPesananRequest $pesananList): UserDataOrderResponse
    {
        $order = new Order();
        $order->idAdmin = $orderan->userId;
        $order->idPengunjung = $orderan->userId;
        $order->waktuPesan = $orderan->waktuPesan;
        $order->noMeja = $orderan->no_meja;
        $order->totalHarga = $orderan->total_harga;
        $order->uangBayar = $orderan->uangBayar;
        $order->uangKembali = $orderan->uangKembali;
        $order->idStatus = $orderan->idStatus;
        $order->namaAdmin = $orderan->namaAdmin;
        $order->namaPengunjung = $orderan->namaPengunjung;
        $orderanku = $this->orderRepository->save($order);

        $this->pesananService = new PesananService();
        foreach ($pesananList as $data) {
            $pesanan = new Pesanan();
            $pesanan->idOreder = $orderanku->id;
            $pesanan->jumlah = $data->jumlah;
            $pesanan->idStatus = $data->idStatus;
            $pesanan->idMenu = $data->idMenu;
            $pesanan->subtotal = $data->subtotal;
            $pesanan->menuNama = $data->menuNama;
            $pesanan->menuHarga = $data->menuHarga;
            $this->pesananRepository->save($pesanan);
        }
    }

}
