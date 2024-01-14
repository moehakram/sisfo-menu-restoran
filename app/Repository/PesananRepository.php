<?php

namespace App\Repository;

use App\Domain\Pesanan;

class PesananRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    // Fungsi untuk menambahkan pesanan baru
    public function save(Pesanan $pesanan): Pesanan
    {
        $query = "INSERT INTO tbl_pesanan_213049 
                  (213049_idorder, 213049_jumlah, 213049_idstatus, 
                   213049_idmenu, 213049_subtotal, 213049_menu_nama, 
                   213049_menu_harga) 
                  VALUES (:idOrder, :jumlah, :idStatus, 
                          :idMenu, :subtotal, :menuNama, 
                          :menuHarga)";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':idOrder', $pesanan->idOrder);
        $stmt->bindParam(':jumlah', $pesanan->jumlah);
        $stmt->bindParam(':idStatus', $pesanan->idStatus);
        $stmt->bindParam(':idMenu', $pesanan->idMenu);
        $stmt->bindParam(':subtotal', $pesanan->subtotal);
        $stmt->bindParam(':menuNama', $pesanan->menuNama);
        $stmt->bindParam(':menuHarga', $pesanan->menuHarga);
        $stmt->execute();
    
        $pesanan->id = $this->connection->lastInsertId();

        return $pesanan;
    }

    // Fungsi untuk mendapatkan daftar semua pesanan
    public function getAllPesanan()
    {
        $query = "SELECT 213049_id, 213049_idorder, 213049_jumlah, 
                          213049_idstatus, 213049_idmenu, 213049_subtotal, 
                          213049_menu_nama, 213049_menu_harga 
                  FROM tbl_pesanan_213049";
        $stmt = $this->connection->query($query);
        $pesananDataList = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
        $pesananList = [];
        foreach ($pesananDataList as $pesananData) {
            $pesanan = new Pesanan();
            $pesanan->id = $pesananData['213049_id'];
            $pesanan->idOrder = $pesananData['213049_idorder'];
            $pesanan->jumlah = $pesananData['213049_jumlah'];
            $pesanan->idStatus = $pesananData['213049_idstatus'];
            $pesanan->idMenu = $pesananData['213049_idmenu'];
            $pesanan->subtotal = $pesananData['213049_subtotal'];
            $pesanan->menuNama = $pesananData['213049_menu_nama'];
            $pesanan->menuHarga = $pesananData['213049_menu_harga'];
    
            $pesananList[] = $pesanan;
        }
    
        return $pesananList;
    }

    // Fungsi untuk mendapatkan detail pesanan berdasarkan ID
    public function getPesananById(int $pesananId): ?Pesanan
    {
        $query = "SELECT 213049_id, 213049_idorder, 213049_jumlah, 
                          213049_idstatus, 213049_idmenu, 213049_subtotal, 
                          213049_menu_nama, 213049_menu_harga 
                  FROM tbl_pesanan_213049 WHERE 213049_id = :pesananId";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':pesananId', $pesananId);
        $stmt->execute();
    
        $pesananData = $stmt->fetch(\PDO::FETCH_ASSOC);
        try {
            if ($pesananData) {
                $pesanan = new Pesanan();
                $pesanan->id = $pesananData['213049_id'];
                $pesanan->idOrder = $pesananData['213049_idorder'];
                $pesanan->jumlah = $pesananData['213049_jumlah'];
                $pesanan->idStatus = $pesananData['213049_idstatus'];
                $pesanan->idMenu = $pesananData['213049_idmenu'];
                $pesanan->subtotal = $pesananData['213049_subtotal'];
                $pesanan->menuNama = $pesananData['213049_menu_nama'];
                $pesanan->menuHarga = $pesananData['213049_menu_harga'];
                
                return $pesanan;
            } else {
                return null;
            }
        } finally {
            $stmt->closeCursor();
        }
    }

    // Fungsi untuk mengupdate pesanan berdasarkan ID
    public function update(Pesanan $pesanan): Pesanan
    {
        $query = "UPDATE tbl_pesanan_213049 
                  SET 213049_idorder = :idOrder, 213049_jumlah = :jumlah, 
                      213049_idstatus = :idStatus, 213049_idmenu = :idMenu, 
                      213049_subtotal = :subtotal, 213049_menu_nama = :menuNama, 
                      213049_menu_harga = :menuHarga 
                  WHERE 213049_id = :pesananId";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':pesananId', $pesanan->id);
        $stmt->bindParam(':idOrder', $pesanan->idOrder);
        $stmt->bindParam(':jumlah', $pesanan->jumlah);
        $stmt->bindParam(':idStatus', $pesanan->idStatus);
        $stmt->bindParam(':idMenu', $pesanan->idMenu);
        $stmt->bindParam(':subtotal', $pesanan->subtotal);
        $stmt->bindParam(':menuNama', $pesanan->menuNama);
        $stmt->bindParam(':menuHarga', $pesanan->menuHarga);
        $stmt->execute();
        
        return $pesanan;
    }

    // Fungsi untuk menghapus pesanan berdasarkan ID
    public function delete(int $pesananId): void
    {
        $query = "DELETE FROM tbl_pesanan_213049 WHERE 213049_id = :pesananId";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':pesananId', $pesananId);
        $stmt->execute();
    }
}
