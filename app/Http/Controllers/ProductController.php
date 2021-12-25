<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        $data = [
            'id' => $id,
            'product_name' => $product->product_name,
            'price' => $product->price
        ];
        
        ActivityLog::LogRecord('Show Product Detail ' . $product->product_name);

        return view('products.show', $data);
    }
}
