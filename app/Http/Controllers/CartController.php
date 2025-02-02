<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\CartItem;

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

    /**
     * Add item to cart.
     */
    public function addItemToCart(Request $request)
    {
        $user = $request->user();
        $productId = $request->input('productId');
        $quantity = $request->input('quantity', 1);

        $cart = DB::table('carts')
            ->select('carts.id')
            ->leftJoin('users', 'users.id', '=', 'carts.user_id')
            ->where('users.id', $user->id)
            ->first();

        DB::table('cart_items')
            ->leftJoin('carts', 'carts.id', '=', 'cart_items.cart_id')
            ->leftJoin('users', 'users.id', '=', 'carts.user_id')
            ->where('users.id', $user->id)
            ->where('carts.id', $cart->id)
            ->insert([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);

        return Inertia::location(route('cart.view'));
    }
}
