<?php

namespace App\Repository;

use App\Domain\User;


class UserRepository{
    private \PDO $connection;

    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }
    
    public function save(User $user): User{
        $statement = $this->connection->prepare("INSERT INTO tbl_user_213049(213049_id, 213049_nama, 213049_password, 213049_idlevel, 213049_idstatus) VALUES (?, ?, ?, ?, ?)");
        $statement->execute([
            $user->id, $user->name, $user->password, $user->level, $user->status
        ]);
        return $user;
    }

    public function update(User $user): User
    {
        $statement = $this->connection->prepare("UPDATE tbl_user_213049 SET 213049_nama = ?, 213049_password = ? WHERE 213049_id = ?");
        $statement->execute([
            $user->name, $user->password, $user->id
        ]);
        return $user;
    }

    public function findById(string $id): ?User
    {
        $statement = $this->connection->prepare("SELECT 213049_id, 213049_nama, 213049_password, 213049_idlevel FROM tbl_user_213049 WHERE 213049_id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['213049_id'];
                $user->name = $row['213049_nama'];
                $user->password = $row['213049_password'];
                $user->level = $row['213049_idlevel'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }
}