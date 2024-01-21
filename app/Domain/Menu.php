<?php

namespace App\Domain;

class Menu{
    public ?int $id;
    public string $nama;
    public string $jenis;
    public int $harga;
    public int $stok;
    public int $status;
    public ?string $gambar;
}