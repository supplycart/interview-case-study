<?php

namespace App\Repositories\Contracts;

use App\Models\Cart;

interface CartRepositoryInterface
{
    public function getUserCart(int $userId): array;
    public function addOrUpdate(int $userId, int $productId, int $qty): Cart;
    public function bulkSync(int $userId, array $items): void;
    public function deleteFromCart(int $userId, int $productId): void;
}
