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

    public function create(UserDataOrderRequest $data): Order
    {
        $order = new Order();
        $order->idAdmin = $data->userId;
        $order->idPengunjung = $data->userId;
        $order->waktuPesan = date("Y-m-d H:i:s");
        $order->noMeja = $data->no_meja;
        $order->totalHarga = $data->total_harga;
        $order->uangBayar = $data->uangBayar;
        $order->uangKembali = $data->uangKembali;
        $order->idStatus = $data->idStatus;
        $order->namaAdmin = $data->namaAdmin;
        $order->namaPengunjung = $data->namaPengunjung;

        $this->orderRepository->save($order);
        return $order;
    }


    public function hasOrderedBefore($userId)
    {
        $sql = "SELECT COUNT(*) FROM tbl_order_213049 WHERE `213049_idpengunjung` = :userId AND `213049_idstatus` = 2";
        $statement = $this->connection->prepare($sql);
        $statement->execute([':userId' => $userId]);
        $result = $statement->fetchColumn();

        return $result > 0;
    }
}
