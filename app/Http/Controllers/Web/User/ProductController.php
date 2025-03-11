<?php

namespace App\Http\Controllers\Web\User;

use App\Actions\Modules\User\Product\GetDetailAction as ProductGetDetailAction;
use App\Actions\Modules\User\Product\GetListingAction as ProductGetListingAction;
use App\Actions\Modules\User\Category\GetListingAction as CategoryGetListingAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProductController extends Controller
{
    public static function index(Request $request)
    {
        $user = Auth::user();
        $productListingRequest = [
            'paginate' => 10,
            'orderBy' => 'id',
            'orderDirection' => 'desc',
        ];

        if (isset($request['category_id']))
        {
            $productListingRequest['filters']['category_id'] = $request['category_id'];
        }

        $products = ProductGetListingAction::execute($user, $productListingRequest);

        $categories = CategoryGetListingAction::execute();

        $props = [];
        $props['products'] = $products;
        $props['categories'] = $categories;

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
        $props['product'] = ProductGetDetailAction::execute($id, $user);

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
