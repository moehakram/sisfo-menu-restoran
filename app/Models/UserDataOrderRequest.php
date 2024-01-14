<?php
namespace app\Models;

class UserDataOrderRequest
{
    public ?int $id = null;
    public ?string $idAdmin = null;
    public ?string $idPengunjung = null;
    public ?string $waktuPesan = null;
    public ?int $noMeja = null;
    public ?int $totalHarga = null;
    public ?int $uangBayar = null;
    public ?int $uangKembali = null;
    public ?int $idStatus = null;
    public ?string $namaAdmin = null;
    public ?string $namaPengunjung = null;
}