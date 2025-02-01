<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\User;
use App\Models\Order;

class ProductController extends Controller {
    /**
     * Display the product detail.
     */
    public function detail(Request $request, int $id): Response
    {
        $product = DB::table('products')
            ->select(
                'products.id', 'products.name', 'products.price',
                'product_brands.name as brandName', 'product_categories.name as categoryName'
            )
            ->leftJoin('product_brands', 'product_brands.id', '=', 'products.brand_id')
            ->leftJoin('product_categories', 'product_categories.id', '=', 'products.category_id')
            ->where('products.id', $id)
            ->first();

        return Inertia::render('Product/Detail', [
            'name' => $product->name,
            'price' => (float) $product->price,
            'brandName' => $product->brandName,
            'categoryName' => $product->categoryName,
        ]);
    }

    /**
     * Display the product detail from order.
     */
    public function orderDetail(Request $request, int $id): Response
    {
        $product = DB::table('products')
            ->select(
                'products.id', 'products.name', 'products.price',
                'product_brands.name as brandName', 'product_categories.name as categoryName'
            )
            ->leftJoin('product_brands', 'product_brands.id', '=', 'products.brand_id')
            ->leftJoin('product_categories', 'product_categories.id', '=', 'products.category_id')
            ->where('products.id', $id)
            ->first();

        return Inertia::render('Product/OrderDetail', [
            'name' => $product->name,
            'price' => (float) $product->price,
            'brandName' => $product->brandName,
            'categoryName' => $product->categoryName,
        ]);
    }
}
