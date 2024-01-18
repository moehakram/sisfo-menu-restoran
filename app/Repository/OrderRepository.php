<?php

namespace App\Repository;

use App\Domain\Order;

class OrderRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Order $order): Order
    {
        $query = "INSERT INTO tbl_order_213049 
                  (213049_idadmin, 213049_idpengunjung, 213049_waktu_pesan, 
                   213049_no_meja, 213049_total_harga, 213049_uang_bayar, 
                   213049_uang_kembali, 213049_idstatus, 213049_nama_admin, 
                   213049_nama_pengunjung) 
                  VALUES (:idAdmin, :idPengunjung, :waktuPesan, 
                          :noMeja, :totalHarga, :uangBayar, 
                          :uangKembali, :idStatus, :namaAdmin, 
                          :namaPengunjung)";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            ':idAdmin' => $order->idAdmin,
            ':idPengunjung' => $order->idPengunjung,
            ':waktuPesan' => $order->waktuPesan,
            ':noMeja' => $order->noMeja,
            ':totalHarga' => $order->totalHarga,
            ':uangBayar' => $order->uangBayar,
            ':uangKembali' => $order->uangKembali,
            ':idStatus' => $order->idStatus,
            ':namaAdmin' => $order->namaAdmin,
            ':namaPengunjung' => $order->namaPengunjung
        ]);
        
    
        $order->id = $this->connection->lastInsertId();

        return $order;
    }

    public function getAll()
    {
        $query = "SELECT 213049_id, 213049_idadmin, 213049_idpengunjung, 
                          213049_waktu_pesan, 213049_no_meja, 213049_total_harga, 
                          213049_uang_bayar, 213049_uang_kembali, 213049_idstatus, 
                          213049_nama_admin, 213049_nama_pengunjung 
                  FROM tbl_order_213049";
        $stmt = $this->connection->query($query);
        $orderDataList = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
        $orderList = [];
        foreach ($orderDataList as $orderData) {
            $order = new Order();
            $order->id = $orderData['213049_id'];
            $order->idAdmin = $orderData['213049_idadmin'];
            $order->idPengunjung = $orderData['213049_idpengunjung'];
            $order->waktuPesan = $orderData['213049_waktu_pesan'];
            $order->noMeja = $orderData['213049_no_meja'];
            $order->totalHarga = $orderData['213049_total_harga'];
            $order->uangBayar = $orderData['213049_uang_bayar'];
            $order->uangKembali = $orderData['213049_uang_kembali'];
            $order->idStatus = $orderData['213049_idstatus'];
            $order->namaAdmin = $orderData['213049_nama_admin'];
            $order->namaPengunjung = $orderData['213049_nama_pengunjung'];
    
            $orderList[] = $order;
        }
    
        return $orderList;
    }

    public function getById(int $orderId): ?Order
    {
        $query = "SELECT 213049_id, 213049_idadmin, 213049_idpengunjung, 
                          213049_waktu_pesan, 213049_no_meja, 213049_total_harga, 
                          213049_uang_bayar, 213049_uang_kembali, 213049_idstatus, 
                          213049_nama_admin, 213049_nama_pengunjung 
                  FROM tbl_order_213049 WHERE 213049_id = :orderId";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([':orderId' => $orderId]);
    
        $orderData = $stmt->fetch(\PDO::FETCH_ASSOC);
   
            if ($orderData) {
                $order = new Order();
                $order->id = $orderData['213049_id'];
                $order->idAdmin = $orderData['213049_idadmin'];
                $order->idPengunjung = $orderData['213049_idpengunjung'];
                $order->waktuPesan = $orderData['213049_waktu_pesan'];
                $order->noMeja = $orderData['213049_no_meja'];
                $order->totalHarga = $orderData['213049_total_harga'];
                $order->uangBayar = $orderData['213049_uang_bayar'];
                $order->uangKembali = $orderData['213049_uang_kembali'];
                $order->idStatus = $orderData['213049_idstatus'];
                $order->namaAdmin = $orderData['213049_nama_admin'];
                $order->namaPengunjung = $orderData['213049_nama_pengunjung'];
                
                return $order;
            } else {
                return null;
            }
    }

    public function getByStatus(int $orderStatus): array
    {
        $query = "SELECT 213049_id, 213049_idadmin, 213049_idpengunjung, 
                          213049_waktu_pesan, 213049_no_meja, 213049_total_harga, 
                          213049_uang_bayar, 213049_uang_kembali, 213049_idstatus, 
                          213049_nama_admin, 213049_nama_pengunjung 
                  FROM tbl_order_213049 WHERE 213049_idstatus = :orderStatus";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([':orderStatus' => $orderStatus]);
    
        $orderList = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $orderDataList = [];
            foreach ($orderList as $orderData) {
                $order = new Order();
                $order->id = $orderData['213049_id'];
                $order->idAdmin = $orderData['213049_idadmin'];
                $order->idPengunjung = $orderData['213049_idpengunjung'];
                $order->waktuPesan = $orderData['213049_waktu_pesan'];
                $order->noMeja = $orderData['213049_no_meja'];
                $order->totalHarga = $orderData['213049_total_harga'];
                $order->uangBayar = $orderData['213049_uang_bayar'];
                $order->uangKembali = $orderData['213049_uang_kembali'];
                $order->idStatus = $orderData['213049_idstatus'];
                $order->namaAdmin = $orderData['213049_nama_admin'];
                $order->namaPengunjung = $orderData['213049_nama_pengunjung'];
                $orderDataList[] = $order;
            }  
        return $orderDataList;
    }


    public function getByKey($key): array
    {
        $query = "SELECT 213049_id, 213049_idadmin, 213049_idpengunjung, 
                          213049_waktu_pesan, 213049_no_meja, 213049_total_harga, 
                          213049_uang_bayar, 213049_uang_kembali, 213049_idstatus, 
                          213049_nama_admin, 213049_nama_pengunjung 
                  FROM tbl_order_213049 WHERE 213049_id = :key OR 213049_idpengunjung = :key OR 213049_nama_pengunjung = :key OR 213049_no_meja = :key AND 213049_idstatus = 2";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([':key' => $key]);
    
        $orderList = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $orderDataList = [];
            foreach ($orderList as $orderData) {
                $order = new Order();
                $order->id = $orderData['213049_id'];
                $order->idAdmin = $orderData['213049_idadmin'];
                $order->idPengunjung = $orderData['213049_idpengunjung'];
                $order->waktuPesan = $orderData['213049_waktu_pesan'];
                $order->noMeja = $orderData['213049_no_meja'];
                $order->totalHarga = $orderData['213049_total_harga'];
                $order->uangBayar = $orderData['213049_uang_bayar'];
                $order->uangKembali = $orderData['213049_uang_kembali'];
                $order->idStatus = $orderData['213049_idstatus'];
                $order->namaAdmin = $orderData['213049_nama_admin'];
                $order->namaPengunjung = $orderData['213049_nama_pengunjung'];
                $orderDataList[] = $order;
            }  
        return $orderDataList;
    }

    public function update(Order $order): Order
    {
        $query = "UPDATE tbl_order_213049 
                  SET 213049_idadmin = :idAdmin, 213049_idpengunjung = :idPengunjung, 
                      213049_waktu_pesan = :waktuPesan, 213049_no_meja = :noMeja, 
                      213049_total_harga = :totalHarga, 213049_uang_bayar = :uangBayar, 
                      213049_uang_kembali = :uangKembali, 213049_idstatus = :idStatus, 
                      213049_nama_admin = :namaAdmin, 213049_nama_pengunjung = :namaPengunjung 
                  WHERE 213049_id = :orderId";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            ':orderId' => $order->id,
            ':idAdmin' => $order->idAdmin,
            ':idPengunjung' => $order->idPengunjung,
            ':waktuPesan' => $order->waktuPesan,
            ':noMeja' => $order->noMeja,
            ':totalHarga' => $order->totalHarga,
            ':uangBayar' => $order->uangBayar,
            ':uangKembali' => $order->uangKembali,
            ':idStatus' => $order->idStatus,
            ':namaAdmin' => $order->namaAdmin,
            ':namaPengunjung' => $order->namaPengunjung
        ]);
        
        return $order;
    }
    public function updateTranx(Order $order): Order
    {
        $query = "UPDATE tbl_order_213049 
                  SET 213049_idadmin = :idAdmin, 213049_uang_bayar = :uangBayar, 
                      213049_uang_kembali = :uangKembali, 213049_idstatus = :idStatus, 
                      213049_nama_admin = :namaAdmin
                  WHERE 213049_id = :orderId";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            ':orderId' => $order->id,
            ':idAdmin' => $order->idAdmin,
            ':uangBayar' => $order->uangBayar,
            ':uangKembali' => $order->uangKembali,
            ':idStatus' => $order->idStatus,
            ':namaAdmin' => $order->namaAdmin
        ]);
        
        return $order;
    }

    public function updateStatus($idOrder): bool {
        $sql = "UPDATE `tbl_order_213049`
        SET `213049_idstatus` = 0
        WHERE `213049_id` = :idorder";

        $statement = $this->connection->prepare($sql);
        $statement->execute([':idorder' => $idOrder]);
        $rowCount = $statement->rowCount();
        return ($rowCount > 0);
}

    public function delete(int $orderId): void
    {
        $query = "DELETE FROM tbl_order_213049 WHERE 213049_id = :orderId";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':orderId', $orderId);
        $stmt->execute();
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
