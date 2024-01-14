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

    public function save(Meja $meja): Meja
    {
        $query = "INSERT INTO tbl_meja_213049 (213049_no_meja, 213049_status_meja) VALUES (:noMeja, :statusMeja)";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            ':noMeja'=> $meja->nomor,
            ':statusMeja'=> $meja->status
        ]);
    
        $meja->setId($this->connection->lastInsertId());

        return $meja;
    }

    public function getAll()
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

    public function getByNo(int $noMeja): ?Meja
    {
        $query = "SELECT 213049_no_meja, 213049_status_meja FROM tbl_meja_213049 WHERE 213049_no_meja = :noMeja";
        $stmt = $this->connection->prepare($query);

        $stmt->execute([':noMeja'=>$noMeja]);
    
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

    public function update(Meja $meja): Meja
    {
        $query = "UPDATE tbl_meja_213049 SET 213049_status_meja = :statusMeja WHERE 213049_no_meja = :noMeja";    
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            ':noMeja'=> $meja->nomor,
            ':statusMeja'=> $meja->status
        ]);

        return $meja;
    }

    public function delete(int $noMeja): void
    {
        $query = "DELETE FROM tbl_meja_213049 WHERE 213049_no_meja = :noMeja";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            ':noMeja'=> $noMeja
        ]);
    }
}
