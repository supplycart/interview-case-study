<?php


namespace App\Services;


use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Support\Facades\Cache;

class GetPreviousOrders
{
    public static function index()
    {
        return Cache::remember(auth()->user()->id . Order::CACHE_NAME, 43200, function () {
            return OrderResource::collection(Order::with([
                'orderedProducts.product'
            ])->whereHas('orderedProducts', function ($q) {
                return $q->index(true);
            })->latest()->get());
        });
    }
}
