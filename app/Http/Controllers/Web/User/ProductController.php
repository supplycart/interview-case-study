<?php

namespace App\Http\Controllers\Web\User;

use App\Actions\Modules\User\Product\GetListingAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProductController extends Controller
{
    public static function index()
    {
        $props = [];
        $props['message'] = 'This is test message';

        $user = Auth::user();
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
        dd('show');
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
