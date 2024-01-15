<?php

namespace App\Domain;

class Pesanan
{
    public int $id;
    public int $idOrder;
    public int $jumlah;
    public int $idStatus;
    public int $idMenu;
    public int $subTotal;
    public string $menuNama;
    public int $menuHarga;
}
