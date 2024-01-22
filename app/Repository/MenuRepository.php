<?php

namespace App\Repository;
use App\Domain\Menu;

class MenuRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Menu $menu): Menu
    {
        $query = "INSERT INTO tbl_menu_213049 
                  (213049_menu_nama, 213049_menu_jenis, 213049_menu_harga, 213049_menu_stok, 213049_idstatus, 213049_menu_gambar) 
                  VALUES (:menuNama, :menuJenis, :menuHarga, :menuStok, :idStatus, :menuGambar)";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            ':menuNama' => $menu->nama,
            ':menuJenis' => $menu->jenis,
            ':menuHarga' => $menu->harga,
            ':menuStok' => $menu->stok,
            ':idStatus' => $menu->status,
            ':menuGambar' => $menu->gambar
        ]);
    
        $menu->id = $this->connection->lastInsertId();

        return $menu;
    }
    
    public function getAll()
    {
        $query = "SELECT 213049_id, 213049_menu_nama, 213049_menu_jenis, 213049_menu_harga, 213049_menu_stok, 213049_idstatus, 213049_menu_gambar FROM tbl_menu_213049";
        $stmt = $this->connection->query($query);
        $menuDataList = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
        $menuList = [];
        foreach ($menuDataList as $menuData) {
            $menu = new Menu();
            $menu->id = $menuData['213049_id'];
            $menu->nama = $menuData['213049_menu_nama'];
            $menu->jenis = $menuData['213049_menu_jenis'];
            $menu->harga = $menuData['213049_menu_harga'];
            $menu->stok = $menuData['213049_menu_stok'];
            $menu->status = $menuData['213049_idstatus'];
            $menu->gambar = $menuData['213049_menu_gambar'];
    
            $menuList[] = $menu;
        }
    
        return $menuList;
    }
    
    public function getById(int $menuId): ?Menu
    {
        $query = "SELECT 213049_id, 213049_menu_nama, 213049_menu_jenis, 213049_menu_harga, 213049_menu_stok, 213049_idstatus, 213049_menu_gambar FROM tbl_menu_213049 WHERE 213049_id = :menuId";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([':menuId' => $menuId]);
    
        $menuData = $stmt->fetch(\PDO::FETCH_ASSOC);
        try{
            if ($menuData) {
                $menu = new Menu();
                $menu->id = $menuData['213049_id'];
                $menu->nama = $menuData['213049_menu_nama'];
                $menu->jenis = $menuData['213049_menu_jenis'];
                $menu->harga = $menuData['213049_menu_harga'];
                $menu->stok = $menuData['213049_menu_stok'];
                $menu->status = $menuData['213049_idstatus'];
                $menu->gambar = $menuData['213049_menu_gambar'];
                
                return $menu;
            } else {
                return null;
            }
        }finally{
            $stmt->closeCursor();
        }
    }

    public function getByJenis(string $jenis)
    {
        $query = "SELECT 213049_id, 213049_menu_nama, 213049_menu_jenis, 213049_menu_harga, 213049_menu_stok, 213049_idstatus, 213049_menu_gambar FROM tbl_menu_213049 WHERE 213049_menu_jenis = :jenis";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            ':jenis' => $jenis
        ]);

        $menuDataList = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
        $menuList = [];
        foreach ($menuDataList as $menuData) {
            $menu = new Menu();
            $menu->id = $menuData['213049_id'];
            $menu->nama = $menuData['213049_menu_nama'];
            $menu->jenis = $menuData['213049_menu_jenis'];
            $menu->harga = $menuData['213049_menu_harga'];
            $menu->stok = $menuData['213049_menu_stok'];
            $menu->status = $menuData['213049_idstatus'];
            $menu->gambar = $menuData['213049_menu_gambar'];
    
            $menuList[] = $menu;
        }
    
        return $menuList;
    }
    public function getByStatus(string $jenis, int $status = 1)
    {
        $query = "SELECT 213049_id, 213049_menu_nama, 213049_menu_jenis, 213049_menu_harga, 213049_menu_stok, 213049_idstatus, 213049_menu_gambar FROM tbl_menu_213049 WHERE 213049_menu_jenis = :jenis AND 213049_idstatus = :idstatus";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            ':jenis' => $jenis,
            ':idstatus' => $status
        ]);

        $menuDataList = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
        $menuList = [];
        foreach ($menuDataList as $menuData) {
            $menu = new Menu();
            $menu->id = $menuData['213049_id'];
            $menu->nama = $menuData['213049_menu_nama'];
            $menu->jenis = $menuData['213049_menu_jenis'];
            $menu->harga = $menuData['213049_menu_harga'];
            $menu->stok = $menuData['213049_menu_stok'];
            $menu->status = $menuData['213049_idstatus'];
            $menu->gambar = $menuData['213049_menu_gambar'];
    
            $menuList[] = $menu;
        }
    
        return $menuList;
    }
    
    public function update(Menu $menu): Menu
    {
        $query = "UPDATE tbl_menu_213049
                  SET 213049_menu_nama = :menuNama, 213049_menu_jenis = :menuJenis, 
                      213049_menu_harga = :menuHarga, 213049_menu_stok = :menuStok, 
                      213049_idstatus = :idStatus, 213049_menu_gambar = :menuGambar 
                  WHERE 213049_id = :menuId";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            ':menuId' => $menu->id,
            ':menuNama' => $menu->nama,
            ':menuJenis' => $menu->jenis,
            ':menuHarga' => $menu->harga,
            ':menuStok' => $menu->stok,
            ':idStatus' => $menu->status,
            ':menuGambar' => $menu->gambar
        ]);
        return $menu;
    }

    public function updateNoGambar(Menu $menu): Menu
    {
        $query = "UPDATE tbl_menu_213049
                  SET 213049_menu_nama = :menuNama, 213049_menu_jenis = :menuJenis, 
                      213049_menu_harga = :menuHarga, 213049_menu_stok = :menuStok, 
                      213049_idstatus = :idStatus
                  WHERE 213049_id = :menuId";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            ':menuId' => $menu->id,
            ':menuNama' => $menu->nama,
            ':menuJenis' => $menu->jenis,
            ':menuHarga' => $menu->harga,
            ':menuStok' => $menu->stok,
            ':idStatus' => $menu->status
        ]);
        return $menu;
    }

    public function delete(int $menuId): void
    {
        $query = "DELETE FROM tbl_menu_213049 WHERE 213049_id = :menuId";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            ':menuId' => $menuId
        ]);
    }
}
