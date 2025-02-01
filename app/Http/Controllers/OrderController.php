<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\User;
use App\Models\Order;

class OrderController extends Controller {
    /**
     * Display the user's order.
     */
    public function view(Request $request): Response
    {
        $user = $request->user();
        $orderList = DB::table('orders')
            ->select('orders.id', 'orders.total_price', 'orders.created_at')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->where('users.id', $user->id)
            ->get();

        return Inertia::render('Order/View', [
            'orderList' => $orderList->map(fn ($order) => [
                'orderId' => (int) $order->id,
                'totalPrice' => (float) $order->total_price,
                'createdAt' => $order->created_at
            ]),
        ]);
    }

    /**
     * Display the user's order.
     */
    public function detail(Request $request, int $id): Response
    {
        $order = DB::table('orders')
            ->select(
                'orders.id', 'orders.total_price', 'orders.created_at',
            )
            ->where('orders.id', $id)
            ->first();
        $productList = DB::table('products')
            ->select(
                'products.id', 'products.name', 'products.price',
                'product_brands.name as brandName', 'product_categories.name as categoryName'
            )
            ->leftJoin('product_brands', 'product_brands.id', '=', 'products.brand_id')
            ->leftJoin('product_categories', 'product_categories.id', '=', 'products.category_id')
            ->leftJoin('order_items', 'order_items.product_id', '=', 'products.id')
            ->leftJoin('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.id', $id)
            ->get();

        return Inertia::render('Order/Detail', [
            'order' => [
                'orderId' => (int) $order->id,
                'totalPrice' => (float) $order->total_price,
                'createdAt' => $order->created_at
            ],
            'productList' => $productList->map(fn ($product) => [
                'productId' => (int) $product->id,
                'productName' => $product->name,
                'productPrice' => (float) $product->price,
                'brandName' => $product->brandName,
                'categoryName' => $product->categoryName,
            ]),
        ]);
    }
}
