<?php

namespace App\Contracts;

/**
 * Interface OrderContract
 * @package App\Contracts
 * @author Haze Illias <hazreenaaida@gmail.com>
 */

interface OrderContract
{
    public function storeOrderDetails($params);

    public function listOrders(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    public function findOrderByNumber($orderNumber);
}