<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
use App\Models\Product;
use Inertia\Inertia;

class OrderController extends Controller
{
    protected OrderRepositoryInterface $orderRepo;

    public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = $this->orderRepo->getUserOrders(auth()->id());

        return Inertia::render('orders/Index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderRepo->createOrder(
            auth()->id(),
            auth()->user()->name ?? 'No Name',
            $request->validated()['items']
        );

        activity()
                ->causedBy(auth()->user())
                ->performedOn($order)
                ->withProperties([
                    'order_id' => $order->id,
                    'receipt_no' => $order->receipt_no,
                    'total' => $order->total,
                    'products' => $order->products->map(fn ($p) => [
                        'product_id' => $p->product_id,
                        'qty' => $p->qty,
                        'price' => $p->price,
                    ]),
                ])
                ->log('Placed an order');


        return response()->json(['message' => 'Order placed successfully']);
    }

}
