<?php

namespace app\repository;

use App\Domain\Session;

class SessionRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Session $session): Session
    {
        $statement = $this->connection->prepare("INSERT INTO tbl_session_213049(213049_id, 213049_iduser) VALUES (?, ?)");
        $statement->execute([$session->id, $session->userId]);
        return $session;
    }

    public function findById(string $id): ?Session
    {
        $statement = $this->connection->prepare("SELECT 213049_id, 213049_iduser FROM tbl_session_213049 WHERE 213049_id = ?");
        $statement->execute([$id]);

        try {
            if($row = $statement->fetch()){
                $session = new Session();
                $session->id = $row['213049_id'];
                $session->userId = $row['213049_iduser'];
                return $session;
            }else{
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM tbl_session_213049 WHERE 213049_id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM tbl_session_213049");
    }

}