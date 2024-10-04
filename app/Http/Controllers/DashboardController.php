<?php

namespace App\Http\Controllers;

use App\Helpers\MasterLookupHelper;
use App\Models\Order;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $orderStatus     = MasterLookupHelper::getKeyByLookUpType('order_status');
        $orderPlaced     = Order::whereStatusId($orderStatus['pending'])->count();
        $orderProcessing = Order::whereStatusId($orderStatus['processing'])->count();
        $orderCompleted  = Order::whereStatusId($orderStatus['completed'])->count();

        return Inertia::render('Dashboard', [
            'orderStatistics' => [
                [
                    'name'  => 'Order Placed',
                    'value' => $orderPlaced,
                    'link'  => route('order.index', ['status' => $orderStatus['pending']])
                ],
                [
                    'name'  => 'Order Processing',
                    'value' => $orderProcessing,
                    'link'  => route('order.index', ['status' => $orderStatus['processing']])
                ],
                [
                    'name'  => 'Order Completed',
                    'value' => $orderCompleted,
                    'link'  => route('order.index', ['status' => $orderStatus['completed']])
                ]
            ]
        ]);
    }
}
