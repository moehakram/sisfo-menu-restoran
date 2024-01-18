<?php

namespace App\Repository;

class JoinTable{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function generateLaporan(){
      
        $sql = "SELECT
        p.`213049_menu_nama` AS nama_menu,
        m.`213049_menu_stok` AS sisa_stok,
        SUM(p.`213049_jumlah`) AS jumlah_terjual,
        p.`213049_menu_harga` AS harga_satuan,
        SUM(p.`213049_subtotal`) AS sub_total
    FROM
        `tbl_pesanan_213049` p
    INNER JOIN
        `tbl_menu_213049` m ON p.`213049_idmenu` = m.`213049_id`
    INNER JOIN
        `tbl_order_213049` o ON o.`213049_id` = p.`213049_idorder`
    WHERE
        p.`213049_idstatus` = 1
    GROUP BY
        p.`213049_menu_nama`, m.`213049_menu_stok`, p.`213049_menu_harga`";

        $statement = $this->connection->prepare($sql);
        // Eksekusi statement
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}