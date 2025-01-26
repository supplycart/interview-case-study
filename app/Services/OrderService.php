<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Services\CartService;
use Exception;


class OrderService
{
    protected $orderRepository;
    protected $cartService;

    public function __construct(OrderRepository $orderRepository,CartService $cartService)
    {
        $this->orderRepository = $orderRepository;
        $this->cartService = $cartService;
    }

    public function placeOrder()
    {
        try {
            $userId = $this->getUserId();
            $cartItems = $this->cartService->getCartItems();
            $subtotal = 0;
            $invoiceNumber = 'INV'.random_int(100000, 999999);
            $items = [];
            foreach ($cartItems as $item) {
                $subtotal += $item->quantity * $item->product->price;
                $items[] = [
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                ];
            }
            $this->orderRepository->createOrder( $userId ,$subtotal, $invoiceNumber,$items);
            return $items;
        } catch (Exception $e) {
         
            $this->logError('Failed to create cart: ' . $e->getMessage());
            throw new Exception('Failed to create cart');
        }

    }

    public function getOrderById($orderId)
    {
        $data = $this->orderRepository->findOrderItemsById($orderId);
        return $data;
    }

    public function getOrders()
    {
        $userId = $this->getUserId();
        return $this->orderRepository->findOrderItemsByUserId($userId);
    
    }

  
    protected function getUserId()
    {
        return auth()->id() ?? null;
    }

    protected function logError(string $message)
    {
        logger()->error($message);
    }
}
