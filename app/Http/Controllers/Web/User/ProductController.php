<?php

namespace App\Http\Controllers\Web\User;

use App\Actions\Modules\User\Product\GetDetailAction;
use App\Actions\Modules\User\Product\GetListingAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProductController extends Controller
{
    public static function index()
    {
        $user = Auth::user();

        $props = [];
        $props['products'] = GetListingAction::execute($user);

        return Inertia::render('user/product/Index', $props);
    }

    public static function create($id)
    {
        dd('create');
    }

    public static function store($request)
    {
        dd('store');
    }

    public static function show($id)
    {
        $user = Auth::user();

        $props = [];
        $props['product'] = GetDetailAction::execute($id, $user);

        return Inertia::render('user/product/Show', $props);
    }

    public static function edit($id)
    {
        dd('edit');
    }

    public static function update($id, $request)
    {
        dd('update');
    }

    public static function delete($id)
    {
        dd('delete');
    }
}
