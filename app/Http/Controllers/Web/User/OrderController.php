<?php

namespace App\Http\Controllers\Web\User;

use App\Actions\Modules\User\Order\CreateAction;
use App\Actions\Modules\User\Order\DeleteAction;
use App\Actions\Modules\User\Order\GetDetailAction;
use App\Actions\Modules\User\Order\GetListingAction;
use App\Actions\Modules\User\Order\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\OrderRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{
    public static function index()
    {
        $user = Auth::user();

        $props = [];
        $props['orders'] = GetListingAction::execute($user);

        return Inertia::render('user/order/Index', $props);
    }

    public static function create($id)
    {
        abort(404);
    }

    public static function store(OrderRequest $request)
    {
        $order = CreateAction::execute($request->validated());

        $user = Auth::user();
        activity()
            ->causedBy($user)
            ->performedOn($order)
            ->log("User has placed an order #{$order->number}");

        return redirect()->route('user.order.show', $order->id);
    }

    public static function show($id)
    {
        $order = GetDetailAction::execute($id);

        $props = [];
        $props['order'] = $order;

        return Inertia::render('user/order/Show', $props);
    }

    public static function edit($id)
    {
        abort(404);
    }

    public static function update(OrderRequest $request, $id)
    {
        // $cartItem = UpdateAction::execute($id, $request->validated());

        // return $cartItem;
    }

    public static function destroy($id)
    {
        abort(404);
    }
}
