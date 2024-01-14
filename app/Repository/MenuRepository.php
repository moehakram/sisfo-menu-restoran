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

    // Fungsi untuk menambahkan menu baru
    public function save(Menu $menu): Menu
    {
        $query = "INSERT INTO tbl_menu_213049 
                  (213049_menu_nama, 213049_menu_jenis, 213049_menu_harga, 213049_menu_stok, 213049_idstatus, 213049_menu_gambar) 
                  VALUES (:menuNama, :menuJenis, :menuHarga, :menuStok, :idStatus, :menuGambar)";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':menuNama', $menu->nama());
        $stmt->bindParam(':menuJenis', $menu->jenis());
        $stmt->bindParam(':menuHarga', $menu->harga());
        $stmt->bindParam(':menuStok', $menu->stok());
        $stmt->bindParam(':idStatus', $menu->status());
        $stmt->bindParam(':menuGambar', $menu->gambar());
        $stmt->execute();
    
        $menu->id = $this->connection->lastInsertId();

        return $menu;
    }
    

    // Fungsi untuk mendapatkan daftar semua menu
    public function getAllMenus()
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
    

    // Fungsi untuk mendapatkan detail menu berdasarkan ID
    public function getMenuById(int $menuId): ?Menu
    {
        $query = "SELECT 213049_id, 213049_menu_nama, 213049_menu_jenis, 213049_menu_harga, 213049_menu_stok, 213049_idstatus, 213049_menu_gambar FROM tbl_menu_213049 WHERE 213049_id = :menuId";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':menuId', $menuId);
        $stmt->execute();
    
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
    // Fungsi untuk mendapatkan detail menu berdasarkan ID
    public function getMenuByJenis(string $jenis)
    {
        $query = "SELECT 213049_id, 213049_menu_nama, 213049_menu_jenis, 213049_menu_harga, 213049_menu_stok, 213049_idstatus, 213049_menu_gambar FROM tbl_menu_213049 WHERE 213049_menu_jenis = :jenis";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':jenis', $jenis);
        $stmt->execute();

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
    

    // Fungsi untuk mengupdate menu berdasarkan ID
    public function update(Menu $menu): Menu
    {
        $query = "UPDATE tbl_menu_213049
                  SET 213049_menu_nama = :menuNama, 213049_menu_jenis = :menuJenis, 
                      213049_menu_harga = :menuHarga, 213049_menu_stok = :menuStok, 
                      213049_idstatus = :idStatus, 213049_menu_gambar = :menuGambar 
                  WHERE 213049_id = :menuId";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':menuId', $menu->id);
        $stmt->bindParam(':menuNama', $menu->nama);
        $stmt->bindParam(':menuJenis', $menu->jenis);
        $stmt->bindParam(':menuHarga', $menu->harga);
        $stmt->bindParam(':menuStok', $menu->stok);
        $stmt->bindParam(':idStatus', $menu->status);
        $stmt->bindParam(':menuGambar', $menu->gambar);
        $stmt->execute();
        return $menu;
    }

    // Fungsi untuk menghapus menu berdasarkan ID
    public function delete(int $menuId): void
    {
        $query = "DELETE FROM tbl_menu_213049 WHERE 213049_id = :menuId";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':menuId', $menuId);
        $stmt->execute();
    }
}
