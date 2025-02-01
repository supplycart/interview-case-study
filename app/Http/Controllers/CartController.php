<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller {
    /**
     * Display the user's cart.
     */
    public function view(Request $request): Response
    {
        $user = $request->user();
        $cartItemList = DB::table('carts')
            ->select(
                'carts.id as cartId',
                'cart_items.quantity as cartItemQuantity',
                'products.id as productId', 'products.name as productName', 'products.price as productPrice',
            )
            ->leftJoin('cart_items', 'cart_items.cart_id', '=', 'carts.id')
            ->leftJoin('products', 'products.id', '=', 'cart_items.product_id')
            ->where('carts.user_id', $user->id)
            ->get();

        return Inertia::render('Cart/View', [
            'cartItemList' => $cartItemList->map(fn ($item) => [
                'cartId' => (int) $item->cartId,
                'cartItemQuantity' => (int) $item->cartItemQuantity,
                'productId' => (int) $item->productId,
                'productName' => $item->productName,
                'productPrice' => (float) $item->productPrice,
            ]),
        ]);
    }
}
