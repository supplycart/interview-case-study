<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = auth()->user()->orders()->paginate(1);
        $orderId = $orders[0]->id ?? null;

        if ($orderId == null) {
            abort(404);
        }

        $items = auth()->user()->orders()
            ->join('item_order', 'orders.id', '=', 'item_order.order_id')
            ->join('items', 'items.id', '=', 'item_order.item_id')
            ->where('orders.id', '=', $orderId)
            ->get();

        $total = 0;

        foreach ($items as $item) {
            $total += $item->price * $item->quantity;
        }

        return view('order', compact('orders', 'items', 'total'));
    }

    public function store()
    {
        $data = request()->validate([
            'items' => ['required', 'array', 'min:1'],
        ]);

        $order = Order::create([
            'status' => 0,
            'user_id' => auth()->id(),
        ]);

        $itemArr = [];

        foreach ($data['items'] as $item) {
            array_push($itemArr, [
                'quantity' => $item['quantity'],
                'item_id' => $item['id'],
                'order_id' => $order->id,
            ]);
        }

        DB::table('item_order')->insert($itemArr);

        auth()->user()->carts()->delete();
    }
}
