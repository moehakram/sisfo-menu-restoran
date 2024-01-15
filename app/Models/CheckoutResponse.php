<?php
namespace app\Models;

use App\Domain\Order;

class CheckoutResponse
{
    public Order $order;
    public array $pesanan;
}