<?php

namespace App\Services;

use App\Repositories\CartRepository;
use Exception;


class CartService
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function addToCart(int $productId)
    {
        try {
            $cart = $this->getCurrentCart();
            $userId = $this->getUserId();
            if (!$cart) {
                $cart = $this->cartRepository->createCart($userId);
            }
        } catch (Exception $e) {
            $this->logError('Failed to create cart: ' . $e->getMessage());
            throw new Exception('Failed to create cart');
        }
        try {
            $existingCartItem = $this->cartRepository->findCartItemByProduct($cart->id, $productId);

            if ($existingCartItem) {
                $this->cartRepository->updateCartItemQuantity($existingCartItem->id, $existingCartItem->quantity + 1);
            } else {
                $this->cartRepository->createCartItem($cart->id, $productId);
            }
        } catch (Exception $e) {
            $this->logError('Failed to add item to cart: ' . $e->getMessage());
            throw new Exception('Failed to add item to cart');
        }
    }

   
    public function countTotalItems()
    {
        $userId = $this->getUserId();

        return $this->cartRepository->getTotalItems($userId);
    }

    protected function getCurrentCart()
    {
        $userId = $this->getUserId();

        return $this->cartRepository->findCartByUserId($userId);
    }

    protected function getUserId()
    {
        return auth()->id() ?? null;
    }

    protected function logError(string $message)
    {
        logger()->error($message);
    }

    public function getCartItems()
    {
        $user_id= $this->getUserId();

        try {
            $cart = $this->cartRepository->findCartItemsByUserId($user_id);

            if ($cart->isEmpty()) {
                return [];
            }

            return $cart->flatMap(function ($cart) {
                return $cart->cartItems;
            });
        } catch (\Exception $e) {
            $this->logError('Failed to get cart items: ' . $e->getMessage());
            throw new Exception('Failed to get cart items');
        }
    }

    public function removeCart(){
        
        $user_id= $this->getUserId();
        try {
           $this->cartRepository->deleteCart($user_id);
        } catch (\Exception $e) {
            $this->logError('Failed to delete cart items: ' . $e->getMessage());
            throw new Exception('Failed to delete cart items');
        }
    }
}
