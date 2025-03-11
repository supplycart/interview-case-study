<?php

namespace App\Http\Controllers\API\User;

use App\Actions\Modules\User\Cart\CreateAction;
use App\Actions\Modules\User\Cart\DeleteAction;
use App\Actions\Modules\User\Cart\GetListingAction;
use App\Actions\Modules\User\Cart\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CartRequest;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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

    public static function store(CartRequest $request)
    {
        $user = Auth::user();
        $cartItem = CreateAction::execute($user, $request->validated());

        return $cartItem;
    }

    public static function show($id)
    {
        abort(404);
    }

    public static function edit($id)
    {
        abort(404);
    }

    public static function update(CartRequest $request, $id)
    {
        $cartItem = UpdateAction::execute($id, $request->validated());

        return $cartItem;
    }

    public static function destroy($id)
    {
        $cartItem = DeleteAction::execute($id);

        return $cartItem;
    }
}
