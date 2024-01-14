<?php

namespace App\Domain;

class Order
{
    public int $id;
    public ?string $idAdmin;
    public ?string $idPengunjung;
    public ?string $waktuPesan;
    public ?int $noMeja;
    public ?int $totalHarga;
    public ?int $uangBayar;
    public ?int $uangKembali;
    public ?int $idStatus;
    public ?string $namaAdmin;
    public ?string $namaPengunjung;
}
