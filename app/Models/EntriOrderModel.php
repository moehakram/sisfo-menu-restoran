<?php
namespace App\Models;

class EntriOrderModel extends \App\Core\MVC\Model {

    public $idOrderBaru;

    public function getMenuByJenis($jenis) {
        $query = "SELECT * FROM tbl_menu_213049 WHERE 213049_menu_jenis = :jenis AND 213049_idstatus = 1";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':jenis', $jenis, \PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getMenuById($id) {
        $query = "SELECT * FROM tbl_menu_213049 WHERE 213049_id = :id";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }   
  
    public function showData($name){
        return [
            "title" => "Entri Order",
            "user" => [
                "name" => $name
            ],
            "makanan" => $this->getMenuByJenis("makanan"),
            "minuman" => $this->getMenuByJenis("minuman"),
            "meja" => $this->meja()
        ];
    } 
    
    private function cleanAndConvertTotalHarga($totalHarga) {
        return intval(preg_replace("/[^0-9]/", "", $totalHarga));
    }
    
    public function save($dataOrder, $dataPesanan){
        try {
            // Mulai transaksi
            $this->connection->beginTransaction();
    
            // Insert data order dan Insert data pesanan
            $dataPesanan['idorder'] = $this->tambahDataOrder($dataOrder);
            $this->tambahDataPesanan($dataPesanan);
            $this->connection->commit();

            return $dataPesanan['idorder'];
        } catch (\PDOException $e) {
            $this->connection->rollBack();
            // Handle the exception, for example:
            // echo "Error: " . $e->getMessage();
        }
    }
    
    // Insert data order
    private function tambahDataOrder($order) {
        $sql = "INSERT INTO tbl_order_213049 (
                    `213049_idadmin`, 
                    `213049_idpengunjung`,
                    `213049_no_meja`, 
                    `213049_total_harga`, 
                    `213049_uang_bayar`, 
                    `213049_uang_kembali`,
                    `213049_idstatus`,
                    `213049_nama_admin`,
                    `213049_nama_pengunjung`
                ) VALUES (
                    :idadmin, 
                    :idpengunjung,
                    :no_meja,
                    :total_harga, 
                    :uang_bayar, 
                    :uang_kembali, 
                    :idstatus,
                    :nama_admin,
                    :nama_pengunjung
                )";    
    
        $statement = $this->connection->prepare($sql);
        $statement->execute([
            ':idadmin' => $order['idadmin'],
            ':idpengunjung' => $order['idpengunjung'],
            ':no_meja' => $order['no_meja'],
            ':total_harga' => $this->cleanAndConvertTotalHarga($order['total_harga']),
            ':uang_bayar' => $order['uang_bayar'],
            ':uang_kembali' => $order['uang_kembali'],
            ':idstatus' => $order['idstatus'],
            ':nama_admin' => $this->getNamaUser($order['idadmin']),
            ':nama_pengunjung' => $this->getNamaUser($order['idpengunjung'])
        ]);
    
        // Mengambil ID order yang baru saja ditambahkan
        $idOrderBaru = $this->connection->lastInsertId();

        
        $this->updateStatusMeja($order['no_meja']);
    
        return $idOrderBaru;
    }
    
    // Insert data pesanan
    private function tambahDataPesanan($pesan) {
        foreach ($pesan['menu_pesan'] as $menu) {
            $sql = "INSERT INTO tbl_pesanan_213049 (213049_idorder, 213049_jumlah, 213049_idstatus, 213049_idmenu, 213049_subtotal, 213049_menu_nama, 213049_menu_harga)
                    VALUES (:idorder, :jumlah, :idstatus, :idmenu, :subtotal, :menu_nama, :menu_harga)";
    
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                ':idorder' => $pesan['idorder'],
                ':jumlah' => $menu['jumlah'],
                ':idstatus' => $pesan['idstatus'],
                ':idmenu' => $menu['id'],
                ':menu_nama' => $menu['nama'],
                ':menu_harga' => $menu['harga'],
                ':subtotal' => $menu['harga']*$menu['jumlah']
            ]);
    
            $this->updateStokMenu($menu['id'], $menu['jumlah']);
            
        }
    }   
    
    
    private function updateStokMenu($idmenu, $qty) {
        $sql = "UPDATE `tbl_menu_213049`
                SET `213049_menu_stok` = `213049_menu_stok` - :qty
                WHERE `213049_id` = :idmenu";
    
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':idmenu', $idmenu, \PDO::PARAM_INT);
        $statement->bindParam(':qty', $qty, \PDO::PARAM_INT);
        $statement->execute();
    }
    private function updateStatusMeja($no_meja) {
        $sql = "UPDATE `tbl_meja_213049`
                SET `213049_status_meja` = 2
                WHERE `213049_no_meja` = :no_meja";
    
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':no_meja', $no_meja, \PDO::PARAM_INT);
        $statement->execute();
    }

    private function getNamaUser($id) {
        $query = "SELECT 213049_nama FROM tbl_user_213049 WHERE 213049_id = :id";
    
        $statement = $this->connection->prepare($query);
        $statement->execute([':id' => $id]);
    
        return $statement->fetchColumn();
    }
    

    public function checkout($data){
        $sql = "SELECT p.`213049_menu_nama` AS nama_menu,
        p.`213049_jumlah` AS jumlah,
        p.`213049_menu_harga` AS harga_satuan,
        p.`213049_subtotal` AS subtotal,
        o.`213049_total_harga` AS total_harga,
        o.`213049_no_meja` AS nomor_meja
FROM `tbl_pesanan_213049` p
JOIN `tbl_order_213049` o ON p.`213049_idorder` = o.`213049_id`
WHERE o.`213049_id` = :idOrder  AND o.`213049_idstatus` = 2";

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':idOrder', $data['idOrder'], \PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
         return [
             "title" => "Entri Order",
             "user" => [
                 "name" => $data['nama']
             ],
             "pesanan" => $result
         ];
    }

    public function hasOrderedBefore($userId) {
        $sql = "SELECT COUNT(*) FROM tbl_order_213049 WHERE `213049_idpengunjung` = :userId AND `213049_idstatus` = 2";
        $statement = $this->connection->prepare($sql);
        $statement->execute([':userId' => $userId]);
        $result = $statement->fetchColumn();
    
        return $result > 0;
    }
   

    public function meja(){
      
        $sql = "SELECT 213049_no_meja, 213049_status_meja FROM tbl_meja_213049";

        // Persiapkan statement
        $statement = $this->connection->prepare($sql);
        // Eksekusi statement
        $statement->execute();

        // Ambil hasil query
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    // public function bookingMeja($user){
    //     return [
    //         "title" => "Booking Meja",
    //         "user" => [
    //             "name" => $user->name
    //         ]
    //     ];
    // } 

}