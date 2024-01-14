<?php
namespace app\Models;

class UserDataOrderRequest
{
    public ?int $id = null;
    public ?int $idOrder = null;
    public ?int $jumlah = null;
    public ?int $idStatus = null;
    public ?int $idMenu = null;
    public ?int $subtotal = null;
    public ?string $menuNama = null;
    public ?int $menuHarga = null;
}