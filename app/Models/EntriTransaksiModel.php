<?php
namespace App\Models;
class EntriTransaksiModel extends \App\Core\MVC\Model {
    
    public function showData($name){
        return [
            "title" => "Entri Referensi",
            "user" => [
                "name" => $name
            ],
            "tx_belumBayar" => $this->getOrderByStatus(2),
            "tx_terdahulu" => $this->getOrderByStatus(1)
        ];
    }

    function getOrderByStatus($status) {
        try {
            // Query SQL untuk mengambil data orderan berdasarkan idpengunjung
            $sql = "SELECT o.213049_no_meja AS nom_meja,
                            u.213049_nama AS pemesan, 
                            o.213049_total_harga AS total_harga, 
                            o.213049_waktu_pesan AS waktu_pesan, 
                            o.213049_id AS idorder
            FROM tbl_order_213049 o
            INNER JOIN tbl_user_213049 u ON o.213049_idpengunjung = u.213049_id
            WHERE o.213049_idstatus = :idstatus";

            // Persiapkan statement
            $statement = $this->connection->prepare($sql);
    
            // Bind parameter dan eksekusi statement dalam satu langkah
            $statement->execute([
                ':idstatus' => $status
            ]);
    
            // Ambil data order sebagai array asosiatif
            $orderData = $statement->fetchAll(\PDO::FETCH_ASSOC);
    
            // Return data order
            return $orderData;
        } catch (\PDOException $e) {
            // Tangkap dan tangani kesalahan eksekusi query
            // echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function fetchData($name, $key) { 
            $sql = "SELECT o.213049_no_meja AS nom_meja,
                            u.213049_nama AS pemesan, 
                            o.213049_total_harga AS total_harga,
                            o.213049_waktu_pesan AS waktu_pesan, 
                            o.213049_id AS idorder
            FROM tbl_order_213049 o
            INNER JOIN tbl_user_213049 u ON o.213049_idpengunjung = u.213049_id
            WHERE o.213049_idpengunjung = :keyword OR o.213049_id = :keyword OR o.213049_no_meja = :keyword AND o.213049_idstatus = 2";

            // Persiapkan statement
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                ':keyword' => $key
            ]);

            $orderData = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return [
                "title" => "Entri Referensi",
                "user" => [
                    "name" => $name
                ],
                "tx_belumBayar" => $orderData,
                "tx_terdahulu" => $this->getOrderByStatus(1)
            ];
      
    }


    public function showDataBayar($user, $id){
        return [
            "title" => "transaksi-bayar",
            "user" => [
                "name" => $user->name
            ],
            "pesanan" =>  $this->finalcheckout($id, 2)
        ];
    }

    public function finalcheckout($id, $status){
      
        $sql = "SELECT p.`213049_menu_nama` AS nama_menu,
        p.`213049_jumlah` AS jumlah,
        p.`213049_menu_harga` AS harga_satuan,
        p.`213049_jumlah` * p.`213049_menu_harga` AS sub_total,
        o.213049_total_harga AS total,
        o.213049_waktu_pesan AS waktu_pesan,
        o.213049_no_meja AS no_meja
FROM `tbl_pesanan_213049` p
INNER JOIN `tbl_order_213049` o ON o.`213049_id` = p.`213049_idorder`
WHERE p.`213049_idorder` = :idorder AND p.`213049_idstatus` = :stus ";

        // Persiapkan statement
        $statement = $this->connection->prepare($sql);

        // Bind parameter
        $statement->bindParam(':idorder', $id, \PDO::PARAM_INT);
        $statement->bindParam(':stus', $status, \PDO::PARAM_INT);
        // Eksekusi statement
        $statement->execute();

        // Ambil hasil query
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);  
        return $result;
        
    }
    

    public function editOrder($user, $data) {
        try {
            // Mulai transaksi
            $this->connection->beginTransaction();
    
            $sql = "UPDATE `tbl_order_213049`
                    SET `213049_uang_bayar` = :uang_bayar,
                    `213049_idadmin` = :idadmin,
                    `213049_uang_kembali` = :uang_kembali,
                    `213049_idstatus`= 1
                    WHERE `213049_id` = :idorder";
    
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':idadmin', $user->id, \PDO::PARAM_STR);
            $statement->bindParam(':uang_bayar', $data['uang_bayar'], \PDO::PARAM_INT);
            $statement->bindParam(':uang_kembali', $data['uang_kembali'], \PDO::PARAM_INT);
            $statement->bindParam(':idorder', $data['idorder'], \PDO::PARAM_INT);
            $statement->execute(); 
            $no_meja = $this->getMejaOrder($data['idorder']);
            $this->updateStatusMeja($no_meja);
            $this->updateStatusPesanan($data['idorder']);

            $this->connection->commit();
        } catch (\PDOException $e) {
            $this->connection->rollBack();
        }  
    }
    public function hapusOrderFix($id) {
            $sql = "UPDATE `tbl_order_213049`
            SET `213049_idstatus` = 0
            WHERE `213049_id` = :idorder";
    
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':idorder', $id, \PDO::PARAM_INT);
            $statement->execute();
            // Ambil jumlah baris yang terpengaruh oleh perintah UPDATE
            $rowCount = $statement->rowCount();
            // Jika ada baris yang terpengaruh, kembalikan true; jika tidak, kembalikan false
            return ($rowCount > 0);
    }
    
    

    private function updateStatusMeja($no_meja) {
        $sql = "UPDATE `tbl_meja_213049`
                SET `213049_status_meja` = 1
                WHERE `213049_no_meja` = :no_meja";
    
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':no_meja', $no_meja, \PDO::PARAM_INT);
        $statement->execute();
    }
    private function updateStatusPesanan($idorder) {
        $sql = "UPDATE `tbl_pesanan_213049`
                SET `213049_idstatus` = 1
                WHERE `213049_idorder` = :idorder";
    
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':idorder', $idorder, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function hapusOrder($id) {
        try {
            // Mulai transaksi
            $this->connection->beginTransaction();
            $no_meja = $this->getMejaOrder($id);
            $this->updateStatusMeja($no_meja);
        $query = "DELETE FROM tbl_order_213049 WHERE `213049_id` = :id";
        
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':id', $id, \PDO::PARAM_INT);
            $statement->execute();
            $result = ($statement->rowCount()) ? true : false ;
            $this->connection->commit();
            
            return $result;
        } catch (\PDOException $e) {
            $this->connection->rollBack();
        } 
    }

    public function print($id){
        return [
            "transaksi" => $this->finalcheckout($id, 1)
        ];
    }

    private function updateStatusOrder($no_meja) {
        $sql = "UPDATE `tbl_meja_213049`
                SET `213049_status_meja` = 2
                WHERE `213049_no_meja` = :no_meja";
    
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':no_meja', $no_meja, \PDO::PARAM_INT);
        $statement->execute();
    }

    private function getMejaOrder($idorder) {
   $sql = "SELECT m.213049_no_meja                            
            FROM tbl_order_213049 o
            INNER JOIN tbl_meja_213049 m ON o.213049_no_meja = m.213049_no_meja
            WHERE o.213049_id = :idorder";

            // Persiapkan statement
            $statement = $this->connection->prepare($sql);
    
            // Bind parameter dan eksekusi statement dalam satu langkah
            $statement->execute([
                ':idorder' => $idorder
            ]);

             // Ambil hasil query, bisa menggunakan fetch jika perlu
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        return $result['213049_no_meja']; 
    }
    


}