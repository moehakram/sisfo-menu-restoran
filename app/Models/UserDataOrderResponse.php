<?php
namespace app\Models;

use App\Domain\Order;
use App\Domain\Pesanan;

class UserDataOrderResponse
{
    public Order $order;
    public Pesanan $pesanan;
}