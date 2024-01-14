<?php

namespace App\Repository;

use App\Domain\Meja;

class MejaRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    // Fungsi untuk menambahkan meja baru
    public function addMeja(Meja $meja): Meja
    {
        $query = "INSERT INTO tbl_meja_213049 (213049_no_meja, 213049_status_meja) VALUES (:noMeja, :statusMeja)";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':noMeja', $meja->nomor);
        $stmt->bindParam(':statusMeja', $meja->status);
        $stmt->execute();
    
        $meja->setId($this->connection->lastInsertId());

        return $meja;
    }

    // Fungsi untuk mendapatkan daftar semua meja
    public function getAllMeja()
    {
        $query = "SELECT 213049_no_meja, 213049_status_meja FROM tbl_meja_213049";
        $stmt = $this->connection->query($query);
        $mejaDataList = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
        $mejaList = [];
        foreach ($mejaDataList as $mejaData) {
            $meja = new Meja();
            $meja->nomor = $mejaData['213049_no_meja'];
            $meja->status = $mejaData['213049_status_meja'];
    
            $mejaList[] = $meja;
        }
    
        return $mejaList;
    }

    // Fungsi untuk mendapatkan detail meja berdasarkan nomor meja
    public function getMejaByNoMeja(int $noMeja): ?Meja
    {
        $query = "SELECT 213049_no_meja, 213049_status_meja FROM tbl_meja_213049 WHERE 213049_no_meja = :noMeja";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':noMeja', $noMeja);
        $stmt->execute();
    
        $mejaData = $stmt->fetch(\PDO::FETCH_ASSOC);
        try {
            if ($mejaData) {
                $meja = new Meja();
                $meja->nomor = $mejaData['213049_no_meja'];
                $meja->status = $mejaData['213049_status_meja'];
                
                return $meja;
            } else {
                return null;
            }
        } finally {
            $stmt->closeCursor();
        }
    }

    // Fungsi untuk mengupdate status meja berdasarkan nomor meja
    public function updateMejaStatus(Meja $meja): Meja
    {
        $query = "UPDATE tbl_meja_213049 SET 213049_status_meja = :statusMeja WHERE 213049_no_meja = :noMeja";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':noMeja', $meja->nomor);
        $stmt->bindParam(':statusMeja', $meja->status);
        $stmt->execute();

        return $meja;
    }

    // Fungsi untuk menghapus meja berdasarkan nomor meja
    public function deleteMeja(int $noMeja): void
    {
        $query = "DELETE FROM tbl_meja_213049 WHERE 213049_no_meja = :noMeja";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':noMeja', $noMeja);
        $stmt->execute();
    }
}
