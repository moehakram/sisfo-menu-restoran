<?php
namespace app\Models;

use App\Domain\Order;

class UserDataOrderResponse
{
    public Order $order;
    public array $pesanan;
}