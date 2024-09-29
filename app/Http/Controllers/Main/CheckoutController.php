<?php

namespace App\Http\Controllers\Main;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Support\Cart;
use App\Providers\RouteServiceProvider;
use App\Models\Order;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!Cart::getCount()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return inertia('Checkout/Index', [
        ]);
    }

    public function store(OrderRequest $request)
    {
        $data = $request->validated();
        /** @var User $user */
        $user = $request->user();

        try {
            \DB::beginTransaction();
            $order = Order::create(Arr::except($data, 'items'));
            $order->orderItems()->createMany($user->cartItems->setVisible(['good_id', 'quantity', 'unit_price'])->toArray());
            $user->cartItems()->delete();
            \DB::commit();

            return to_route('profile.orders');
        } catch (\Exception $exception) {
            \DB::rollBack();
            \Log::error($exception->getMessage());

            return redirect()->back();
        }
    }
}
