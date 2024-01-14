<?php

namespace App\Domain;

class Pesanan
{
    public int $id;
    public int $idOrder;
    public int $jumlah;
    public int $idStatus;
    public int $idMenu;
    public int $subtotal;
    public string $menuNama;
    public int $menuHarga;
}
