<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Events\ProductAddedToCart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;

class ApiController extends Controller
{
    public function getProducts(Request $request)
    {
        if (!empty($request->catId)) {
            $products = Product::whereHas('categories', function ($q) use ($request) {
                $q->whereCategoryId($request->catId);
            })->get();
        } else {
            $products = Product::all();    
        }
        
        return response()
            ->json($products->collect(), Response::HTTP_OK);
    }

    public function getCart(Request $request)
    {
        $cart = session('cart', []);
        $productIds = [];

        foreach ($cart as $item) {
            $productIds[] = $item['id'];
        }

        $products = Product::findMany($productIds);

        foreach ($products as $item) {
            $item->incart_qty = $cart[$item->id]['qty'];
        }

        return response()->json($products, Response::HTTP_OK);
    }

    public function updateCart(Request $request)
    {
        $productId = $request->product_id;
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(false, Response::HTTP_OK);
        }

        // Indicates if cart update is required
        $update = true;
        $quantity = [
            'before' => 0,
            'after' => $request->quantity ?? 1,
            'current' => $request->quantity ?? null,
        ];

        $cart = session('cart', []);

        if (!empty($cart[$productId])) {
            $quantity['before'] = $cart[$productId]['qty'];
            $quantity['after'] = $quantity['current'];
            var_dump($cart[$productId]['qty']);
            if (!empty($quantity['current'])) {
                $quantity['after'] = $quantity['current'];
            } elseif (is_null($quantity['current'])) {
                $quantity['after'] = $quantity['current'] = ++$cart[$productId]['qty'];
            } elseif (!is_null($quantity['current'])
                && empty($quantity['current'])
            ) {
                $update = false;
            }
        }

        if ($update) {
            $cart[$productId] = [
                'id' => $productId,
                'qty' => $quantity['after'],
            ];
        } else {
            unset($cart[$productId]);
        }

        session(['cart' => $cart]);

        event(new ProductAddedToCart(auth()->user(), $product, $quantity));

        return response()->json(true, Response::HTTP_OK);
    }

    public function getOrders(Request $request)
    {
        $orders = Order::where('user_id', auth()->user()->id)
            ->get()
            ->load('products');

        return response()->json($orders, Response::HTTP_OK);
    }

    public function createOrder(Request $request)
    {
        $cart = session('cart', []);

        if ($cart) {
            $productIds = array_column($cart, 'id');
            $products = Product::findMany($productIds);

            $orderProducts = [];
            $totalPrice = 0;
            foreach ($products as $item) {
                $orderProducts[] = [
                    'product_id' => $item->id,
                    'quantity' => $cart[$item->id]['qty'],
                    'unit_price' => $item->price,
                ];
                $totalPrice += $item->price * $cart[$item->id]['qty'];
            }

            $order = Order::create([
                'order_number' => uniqid(),
                'user_id' => auth()->user()->id,
                'total' => $totalPrice,
                'item_count' => $products->count(),
                'shipping_info' => json_encode([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'street_address' => $request->street_address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'country' => $request->country,
                    'postcode' => $request->postcode,
                    'phone_number' => $request->phone_number,
                    'notes' => $request->notes,
                ]),
            ]);
            $order->save();

            if ($order) {
                foreach ($orderProducts as $arrItem) {
                    $order->products()->attach($arrItem['product_id'], array_merge($arrItem, [
                        'order_id' => $order->id,
                    ]));
                }
            }

            session(['cart' => []]);

            event(new OrderCreated(auth()->user(), $order));
        }

        return redirect()->route('user.order-history');
    }

    public function getActivities(Request $request)
    {
        $activities = Activity::inLog('app')
            ->causedBy(auth()->user())
            ->get();

        foreach ($activities as $item) {
            $desc = '';
            if ($item->subject instanceof Product) {
                $desc = sprintf(' (%s)', $item->subject->name);
            } elseif ($item->subject instanceof Order) {
                $desc = sprintf(': #%s', $item->subject->order_number);
            }
            $item->description_new = $item->description . $desc;
            $item->created_at_new = Carbon::parse($item->created_at)->format('Y-m-d H:i:s A');
        }

        return response()->json($activities, Response::HTTP_OK);
    }

    public function getCategories(Request $request)
    {
        $categories = \App\Models\Category::all();
        return response()->json($categories);
    }
}
