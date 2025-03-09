<?php

namespace App\Http\Controllers\Web\User;

use App\Actions\Modules\User\Product\GetListingAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CartController extends Controller
{
    public static function index()
    {
        dd('index');
    }

    public static function create($id)
    {
        dd('create');
    }

    public static function store(Request $request)
    {
        dd('store', $request->all());
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
