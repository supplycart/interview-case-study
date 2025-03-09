<?php

namespace App\Http\Controllers\API\User;

use App\Actions\Modules\User\Product\GetDetailAction;
use App\Actions\Modules\User\Product\GetListingAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public static function index()
    {
        $user = Auth::user();
        $products = GetListingAction::execute($user);

        return $products;
    }

    public static function create($id)
    {
        abort(404);
    }

    public static function store($request)
    {
        abort(404);
    }

    public static function show($id)
    {
        $products = GetDetailAction::execute($id);

        return $products;
    }

    public static function edit($id)
    {
        abort(404);
    }

    public static function update($id, $request)
    {
        abort(404);
    }

    public static function delete($id)
    {
        abort(404);
    }
}
