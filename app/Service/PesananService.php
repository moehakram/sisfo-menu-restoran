<?php

namespace App\Service;

use App\Domain\Menu;
use App\Repository\OrderRepository;
use App\Repository\PesananRepository;
use App\Models\UserDataOrderRequest;
use App\Models\UserDataPesanRequest;

use App\Core\Database\Database;

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

    public function create(int $orderId, UserDataPesanRequest $data): Pesanan
    {
        $pesanan = new Pesanan();
        $pesanan->idOreder = $orderId;
        $pesanan->jumlah = $data->jumlah;
        $pesanan->idStatus = $data->idStatus;
        $pesanan->idMenu = $data->idMenu;
        $pesanan->subtotal = $data->subtotal;
        $pesanan->menuNama = $data->menuNama;
        $pesanan->menuHarga = $data->menuHarga;
        return $pesanan;
    }

}
