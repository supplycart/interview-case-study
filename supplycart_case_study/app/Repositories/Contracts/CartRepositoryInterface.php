<?php

namespace App\Repositories\Contracts;

interface CartRepositoryInterface
{
    public function getUserCart(int $userId): array;
    public function addOrUpdate(int $userId, int $productId, int $qty): void;
    public function bulkSync(int $userId, array $items): void;
    public function deleteFromCart(int $userId, int $productId): void;
}
