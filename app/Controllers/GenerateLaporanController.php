<?php

namespace App\Controllers;

use App\Core\Database\Database;
use App\Core\MVC\{Controller, View};
use App\Repository\JoinTable;

class GenerateLaporanController extends Controller {

    public function index() {
        $data = (new JoinTable(Database::getConnection()))->generateLaporan();
        $html = View::renderView('admin/generate-laporan', [
            "title" => "Entri Referensi",
            "user" => [
                "name" => $this->user->name
            ],
            "laporan" => $data
        ]);
        $this->response->setContent($html);
    }

    public function printLaporan() {
        $data = (new JoinTable(Database::getConnection()))->generateLaporan();
        $html = View::renderViewOnly('admin/print-laporan', [
            "title" => "Entri Referensi",
            "user" => [
                "name" => $this->user->name
            ],
            "laporan" => $data
        ]);
        $this->response->setContent($html);
    }

}