<?php

namespace App\Http\Controllers;

use App\Actions\Orders\StoreOrderAction;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query()
            ->withCount('items')
            ->with([
                'status:id,value',
                'paymentInfo' => function (HasOne $query) {
                    $query
                        ->select(['id', 'order_id', 'status_id'])
                        ->with('status:id,value');
                }
            ])
            ->latest()
            ->paginate(10, ['*'], 'page', $request->input('page', 1))
            ->withQueryString();

        return Inertia::render('Order/Index', [
            'orders' => $orders
        ]);
    }

    public function store(StoreOrderRequest $request, StoreOrderAction $action)
    {
        try {
            $orderNumber = $action->execute(
                $request->validated()
            );

            return response()->json(['orderNumber' => $orderNumber], Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Order $order)
    {
        $order->load([
            'items.product.image',
            'address',
            'paymentInfo.status:id,value',
            'status:id,value'
        ]);

        return Inertia::render('Order/Detail', [
            'order' =>$order->load(['items.product.image', 'address', 'paymentInfo.status', 'status'])
        ]);
    }

    public function summary(Order $order)
    {
        return Inertia::render('Order/Confirmation', [
            'order' => $order->load('address'),
        ]);
    }
}
