<?php

namespace App\Repository;

use App\Domain\Status;

class StatusRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    // Fungsi untuk menambahkan status baru
    public function save(Status $status): Status
    {
        $query = "INSERT INTO tbl_status_213049 
                  (213049_status_user, 213049_status_pesan, 213049_status_order, 
                   213049_status_menu, 213049_status_meja) 
                  VALUES (:statusUser, :statusPesan, :statusOrder, 
                          :statusMenu, :statusMeja)";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            ':statusUser' => $status->statusUser,
            ':statusPesan' => $status->statusPesan,
            ':statusOrder' => $status->statusOrder,
            ':statusMenu' => $status->statusMenu,
            ':statusMeja' => $status->statusMeja
        ]);
    
        $status->id = $this->connection->lastInsertId();

        return $status;
    }

    // Fungsi untuk mendapatkan daftar semua status
    public function getAll()
    {
        $query = "SELECT 213049_id, 213049_status_user, 213049_status_pesan, 
                          213049_status_order, 213049_status_menu, 213049_status_meja 
                  FROM tbl_status_213049";
        $stmt = $this->connection->query($query);
        $statusDataList = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
        $statusList = [];
        foreach ($statusDataList as $statusData) {
            $status = new Status();
            $status->id = $statusData['213049_id'];
            $status->statusUser = $statusData['213049_status_user'];
            $status->statusPesan = $statusData['213049_status_pesan'];
            $status->statusOrder = $statusData['213049_status_order'];
            $status->statusMenu = $statusData['213049_status_menu'];
            $status->statusMeja = $statusData['213049_status_meja'];
    
            $statusList[] = $status;
        }
    
        return $statusList;
    }

    // Fungsi untuk mendapatkan detail status berdasarkan ID
    public function getById(int $statusId): ?Status
    {
        $query = "SELECT 213049_id, 213049_status_user, 213049_status_pesan, 
                          213049_status_order, 213049_status_menu, 213049_status_meja 
                  FROM tbl_status_213049 WHERE 213049_id = :statusId";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([':statusId' => $statusId]);
    
        $statusData = $stmt->fetch(\PDO::FETCH_ASSOC);
        try {
            if ($statusData) {
                $status = new Status();
                $status->id = $statusData['213049_id'];
                $status->statusUser = $statusData['213049_status_user'];
                $status->statusPesan = $statusData['213049_status_pesan'];
                $status->statusOrder = $statusData['213049_status_order'];
                $status->statusMenu = $statusData['213049_status_menu'];
                $status->statusMeja = $statusData['213049_status_meja'];
                
                return $status;
            } else {
                return null;
            }
        } finally {
            $stmt->closeCursor();
        }
    }

    // Fungsi untuk mengupdate status berdasarkan ID
    public function update(Status $status): Status
    {
        $query = "UPDATE tbl_status_213049 
                  SET 213049_status_user = :statusUser, 213049_status_pesan = :statusPesan, 
                      213049_status_order = :statusOrder, 213049_status_menu = :statusMenu, 
                      213049_status_meja = :statusMeja 
                  WHERE 213049_id = :statusId";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            ':statusId' => $status->id,
            ':statusUser' => $status->statusUser,
            ':statusPesan' => $status->statusPesan,
            ':statusOrder' => $status->statusOrder,
            ':statusMenu' => $status->statusMenu,
            ':statusMeja' => $status->statusMeja
        ]);
        
        return $status;
    }

    // Fungsi untuk menghapus status berdasarkan ID
    public function delete(int $statusId): void
    {
        $query = "DELETE FROM tbl_status_213049 WHERE 213049_id = :statusId";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            ':statusId' => $statusId
        ]);
    }
}
