<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use App\Models\Product;
use App\Http\Helpers\Cart;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CartResource;
use App\Http\Requests\AddCartRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ShoppingCartController extends Controller
{
    public function index(AddCartRequest $request)
    {
        list($products, $cartItems) = Cart::getProductsAndCartItems();
        $total = 0;
        foreach ($products as $product) {
            $total += $product->product_price * $cartItems[$product->id]['quantity'];
        }

        // return CartResource()
        $user = $request->user();
        
        return CartResource::collection(ShoppingCart::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get());

    }

    public function add(AddCartRequest $request, Product $product)
    {
        $quantity = $request->post('quantity', 1);
        $user = $request->user();
        if ($user) {

            $cartItem = ShoppingCart::where(['user_id' => $user->id, 'product_id' => $product->id])->first();

            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->update();
            } else {
                $data = [
                    'user_id' => $request->user()->id,
                    'product_id' => $product->id,
                    'product_name'=> $product->product_name,
                    'product_price'=>$product->product_price,
                    'product_image'=>$product->product_image,
                    'quantity' => $quantity,
                ];
                ShoppingCart::create($data);
            }

            return response([
                'count' => Cart::getCartItemsCount()
            ]);
        } else {
            $cartItems = json_decode($request->cookie('cart_items', '[]'), true);
            $productFound = false;
            foreach ($cartItems as &$item) {
                if ($item['product_id'] === $product->id) {
                    $item['quantity'] += $quantity;
                    $productFound = true;
                    break;
                }
            }
            if (!$productFound) {
                $cartItems[] = [
                    'user_id' => null,
                    'product_id' => $product->id,
                    'product_name'=> $product->product_name,
                    'product_price'=>$product->product_price,
                    'product_image'=>$product->product_image,
                    'quantity' => $quantity,
                ];
            }
            Cookie::queue('cart_items', json_encode($cartItems), 60 * 24 * 30);

            return response(['count' => Cart::getCountFromItems($cartItems)]);
        }
    }
    
    public function remove(Request $request, Product $product)
    {
        $user = $request->user();
        if ($user) {
            $cartItem = ShoppingCart::query()->where(['user_id' => $user->id, 'product_id' => $product->id])->first();
            if ($cartItem) {
                $cartItem->delete();
            }

            return response([
                'count' => Cart::getCartItemsCount(),
            ]);
        } else {
            $cartItems = json_decode($request->cookie('shopping_carts', '[]'), true);
            foreach ($cartItems as $i => &$item) {
                if ($item['product_id'] === $product->id) {
                    array_splice($cartItems, $i, 1);
                    break;
                }
            }
            Cookie::queue('shopping_carts', json_encode($cartItems), 60 * 24 * 30);

            return response(['count' => Cart::getCountFromItems($cartItems)]);
        }
    }
    public function updateQuantity(Request $request, Product $product)
    {
        $quantity = (int)$request->post('quantity');
        $user = $request->user();
        if ($user) {
            ShoppingCart::where(['user_id' => $request->user()->id, 'product_id' => $product->id])->update(['quantity' => $quantity]);

            return response([
                'count' => Cart::getCartItemsCount(),
            ]);
        } else {
            $cartItems = json_decode($request->cookie('shopping_carts', '[]'), true);
            foreach ($cartItems as &$item) {
                if ($item['product_id'] === $product->id) {
                    $item['quantity'] = $quantity;
                    break;
                }
            }
            Cookie::queue('shopping_carts', json_encode($cartItems), 60 * 24 * 30);

            return response(['count' => Cart::getCountFromItems($cartItems)]);
        }
    }
}