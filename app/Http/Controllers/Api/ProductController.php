<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductFilterRequest;
use App\Http\Resources\ProductsCollection;
use App\Models\Product;
use DB;
use Validator;

class ProductController extends Controller
{

    public function index(ProductFilterRequest $request)
    {
        $products = Product::query()->with(['brand', 'category']);

        $isFilter = false;
        foreach ($request->data() as $column => $values) {
            if (!empty($values)) {
                $products->whereIn($column, $values);
                $isFilter = true;
            }
        }

        if ($isFilter) {
            activity()->withProperties(['user_agent' => $request->header('User-Agent')])->log('Search product with filter');
        }

        $products = $products->paginate(6);

        return response()->json(
            new ProductsCollection($products)
        );
    }

}
