<?php

namespace App\Models;

class EditMenuRequest{
    public ?int $id = null;
    public ?string $nama = null;
    public ?string $jenis = null;
    public ?int $harga = null;
    public ?int $stok = null;
    public ?int $status = null;
    public $gambar = null;
}