<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return inertia('Index/Orders', [
            'orders' => OrderResource::collection($request->user()->orders->load('orderItems', 'orderItems.good')),
        ]);
    }
}
