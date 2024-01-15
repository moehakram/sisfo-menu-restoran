<?php
namespace app\Models;

class UserDataPesanRequest
{
    public ?int $id = null;
    public ?int $idOrder = null;
    public ?int $jumlah = null;
    public ?int $idStatus = null;
    public ?int $idMenu = null;
    public ?int $subTotal = null;
    public ?string $menuNama = null;
    public ?int $menuHarga = null;
}