<?php
namespace App\Http\Helpers;

use App\Models\ShoppingCart;
use Illuminate\Support\Arr;
use App\Models\Product;

class Cart
{
    public static function getCartItemsCount(): int
    {
        $request = \request();
        $user = $request->user();
        if($user){
            return ShoppingCart::where('user_id', $user->id)->sum('quantity');
        } else{
            $cartItems= self::getCookieCartItems();
            return array_reduce(
                $cartItems,
                fn($carry,$item) => $carry+$item['quantity'],
                0
            );
        }
    }

    public static function getCartItems()
    {
        $request = \request();
        $user = $request->user();
        if($user){
            return ShoppingCart::where('user_id', $user->id)->get()->map(
                fn($item) => ['product_id' => $item->product_id, 'quantity' => $item->quantity,'product_name'=>$item->product_name,'product_image'=>$item->product_image,'product_price'=>$item->product_price]
            );
        } else {
            return self::getCookieCartItems();
        }
    }

    public static function getCookieCartItems()
    {
        $request = \request();
        return json_decode($request->cookie('cart_items', '[]'), true);
    }

    public static function getCountFromItems($cartItems)
    {
        return array_reduce(
            $cartItems,
            fn($carry, $item) => $carry + $item['quantity'],
            0
        );
    }

    public static function moveCartItemsIntoDb()
    {
        $request = \request();
        $cartItems = self::getCookieCartItems();
        $dbCartItems = ShoppingCart::where(['user_id' => $request->user()->id])->get()->keyBy('product_id');
        $newCartItems = [];
        foreach ($cartItems as $cartItem) {
            if (isset($dbCartItems[$cartItem['product_id']])) {
                continue;
            }
            $newCartItems[] = [
                'user_id' => $request->user()->id,
                'product_id' => $cartItem['product_id'],
                
                'quantity' => $cartItem['quantity'],
            ];
        }

        if (!empty($newCartItems)) {
            CartItem::insert($newCartItems);
        }
    }

    public static function getProductsAndCartItems(): array|\Illuminate\Database\Eloquent\Collection
    {
        $cartItems = self::getCartItems();
        $ids = Arr::pluck($cartItems, 'product_id');
        $products = Product::query()->whereIn('id', $ids)->get();
        $cartItems = Arr::keyBy($cartItems, 'product_id');

        return [$products, $cartItems];
    }
}