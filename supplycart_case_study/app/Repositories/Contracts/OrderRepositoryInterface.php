<?php

namespace App\Repositories\Contracts;

interface OrderRepositoryInterface
{
    public function getUserOrders(int $userId): array;
    public function createOrder(int $userId, string $fullName, array $items): void;
}
