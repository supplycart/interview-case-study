<?php

namespace App\Http\Controllers\API\User;

use App\Actions\Modules\User\Order\CreateAction;
use App\Actions\Modules\User\Order\DeleteAction;
use App\Actions\Modules\User\Order\GetListingAction;
use App\Actions\Modules\User\Order\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\OrderRequest;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public static function index()
    {
        $user = Auth::user();
        $cartItems = GetListingAction::execute($user);

        return $cartItems;
    }

    public static function create($id)
    {
        abort(404);
    }

    public static function store(OrderRequest $request)
    {
        $order = CreateAction::execute($request->validated());

        return $order;
    }

    public static function show($id)
    {
        abort(404);
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
