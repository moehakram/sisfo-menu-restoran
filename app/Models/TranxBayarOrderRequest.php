<?php
namespace App\Models;

class TranxBayarOrderRequest
{
    public int $id;
    public ?string $idAdmin;
    public ?int $uangBayar;
    public ?int $uangKembali;
    public int $idStatus;
    public ?string $namaAdmin;
    public int $noMeja;
}