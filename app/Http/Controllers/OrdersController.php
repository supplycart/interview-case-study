<?php

namespace App\Http\Controllers;

use Exception;
use App\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders', compact('orders'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            Order::create_order($request);
            return response()->json(['status' => 1, 'message' => 'Order Created']);
        }
        catch (Exception $e) {
            return response()->json(['status' => 0, 'message' => 'Failed to create Order']);
        }
    }
}
