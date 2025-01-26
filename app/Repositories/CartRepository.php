<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Carbon;

class CartRepository
{
    private $cartModel;
    private $cartItemModel;

    public function __construct(Cart $cartModel, CartItem $cartItemModel)
    {
        $this->cartModel = $cartModel;
        $this->cartItemModel = $cartItemModel;
    }

    /**
     * Find a cart by user ID.
     *
     * @param int|null  $userId
     * @return Cart|null
     */
    public function findCartByUserId(int $userId): ?Cart
    {
        return $this->cartModel
            ->Where('user_id', $userId)
            ->first();
    }

    /**
     * sum total items in cart.
     *
     * @param int|null  $userId
     * @return Cart|null
     */
    public function getTotalItems(int $userId)
    {
        $cart= $this->cartModel
                ->Where('user_id', $userId)
                ->first();
        if(!$cart){
            return 0;
        }
        return $cart->cartItems->sum('quantity');
    }

 
    /**
     * Find a cart item by cart ID and product ID.
     *
     * @param int $cartId
     * @param int $productId
     * @return CartItem|null
     */
    public function findCartItemByProduct(int $cartId, int $productId): ?CartItem
    {
        return $this->cartItemModel
            ->where('cart_id', $cartId)
            ->where('product_id', $productId)
            ->first();
    }

    /**
     * Find a cart by user ID  with associated items.
     *
     * @param int|null    $userId
     * @return Collection|null
     */
    public function findCartItemsByUserId(int $user_id):Collection
    {
        return $this->cartModel
            ->where('user_id', $user_id)
            ->with('cartItems.product')
            ->get();
    }

    /**
     * Create a new cart.
     *
     * @param string $user_id
     * @return Cart 
     */
    public function createCart(string $user_id): Cart
    {

        return $this->cartModel->create([
            'user_id' => $user_id,
        ]);
    }

    /**
     * Create a new cart item.
     *
     * @param int $cartId
     * @param int $productId
     * @return CartItem
     */
    public function createCartItem(int $cartId, int $productId): CartItem
    {
        return $this->cartItemModel::create([
            'cart_id' => $cartId,
            'product_id' => $productId,
            'quantity' => 1,
        ]);
    }



    /**
     * Update the quantity of a cart item.
     *
     * @param int $cartItemId
     * @param int $quantity
     * @return int
     */
    public function updateCartItemQuantity(int $cartItemId, int $quantity): int
    {
        return $this->cartItemModel::where('id', $cartItemId)
            ->update(['quantity' => $quantity]);
    }

     /**
     * Delete a cart & items.
     *
     * @param int $userId
     * @return int
     */
    public function deleteCart(int $userId): int
    {
        return $this->cartModel
            ->where('user_id', $userId)
            ->delete();
    }

}
