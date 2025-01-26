<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;

class OrderRepository
{
    private $orderModel;
    private $orderItemModel;

    public function __construct(Order $orderModel, OrderItem $orderItemModel)
    {
        $this->orderModel = $orderModel;
        $this->orderItemModel = $orderItemModel;
    }

    /**
     * Create a new order.
     * save order items
     *
     * @param string $user_id
     * @param string $subTotal
     * @param string $invoice_number
     * @return Order 
     */
    public function createOrder(string $user_id,string $subTotal,string $invoice_number,array $items): Order
    {

        $order = $this->orderModel->create([
            'user_id' => $user_id,
            'invoice_number'=>$invoice_number,
            'sub_total'=>$subTotal
        ]);

        $order->orderItems()->createMany($items);

        return $order;
    }

     /**
     * Get all orders with associated items.
     *
     * @param int $userId
     * @return Collection|null
     */
    public function findOrderItemsByUserId(int $user_id):Collection
    {
        return $this->orderModel
            ->where('user_id', $user_id)
            ->with('orderItems.product')
            ->get();
    }

    /**
     * Find a order by order ID .
     *
     * @param int    $userId
     * @return Order
     */
    public function findOrderItemsById(int $orderId):Order
    {
        return $this->orderModel
            ->where('id', $orderId)
            ->with('orderItems.product')
            ->first();
    }

  


}