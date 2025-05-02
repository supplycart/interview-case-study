<?php

namespace App\Repositories\Contracts;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function getUserOrders(int $userId): array;
    public function createOrder(int $userId, string $fullName, array $items): Order;
}
