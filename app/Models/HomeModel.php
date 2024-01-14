<?php
namespace App\Models;
class HomeModel extends \App\Core\MVC\Model {

    public function dataIndex() {
        return [
            "title" => "Login Management",
            "makanan" => $this->getMenuByJenis("makanan"),
            "minuman" => $this->getMenuByJenis("minuman")
        ];
    }

    public function getMenuByJenis($jenis) {
        $query = "SELECT * FROM tbl_menu_213049 WHERE 213049_menu_jenis = :jenis AND 213049_idstatus = 1";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':jenis', $jenis, \PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function dataDashboard($user) {
        return [
            "title" => "Dashboard",
            "user" => [
                "name" => $user->name
            ],
            "jumlahMenu" => $this->jumlahMenu(),
            "jumlahOrder" => $this->jumlahOrder(),
            "pemasukan" => $this->pemasukan()
        ];
    }

    function is_admin($userId) {
        try {
            // Query SQL untuk mengambil data level berdasarkan iduser
            $sql = "SELECT `213049_idlevel` FROM tbl_user_213049 WHERE `213049_id` = :userId";
    
            // Persiapkan statement
            $statement = $this->connection->prepare($sql);
    
            // Bind parameter dan eksekusi statement dalam satu langkah
            $statement->execute([
                ':userId' => $userId,
            ]);
    
            // Ambil data level sebagai array asosiatif
            $userData = $statement->fetch(\PDO::FETCH_ASSOC);
    
            // Periksa apakah level adalah level administrasi (sesuaikan dengan struktur level Anda)
            return $userData && $userData['213049_idlevel'] == 1; // Ganti 1 dengan level administrasi yang sesuai
        } catch (\PDOException $e) {
            // Tangkap dan tangani kesalahan eksekusi query
            // echo "Error: " . $e->getMessage();
            return false;
        }
    }

    private function jumlahMenu() {
        $sql = "SELECT COUNT(*) FROM tbl_menu_213049";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchColumn();
    
        return $result;
    }
    private function jumlahOrder() {
        $sql = "SELECT COUNT(*) FROM tbl_order_213049";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }
    private function pemasukan() {
        $sql = "SELECT SUM(213049_total_harga) FROM tbl_order_213049";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    private function pegawai() {
        $sql = "SELECT COUNT(*) FROM tbl_pegawai_213049";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

}
