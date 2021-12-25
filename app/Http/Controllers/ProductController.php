<?php

namespace App\Http\Controllers;

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
        $product_name = '';
        $price = 0;
        if($id == 1) {
            $product_name = 'Women\'s Red dress';
            $price = 225.00;
        } else {
            $product_name = 'Hawa Luxe Premium';
            $price = 315.00;
        }

        $data = [
            'id' => $id,
            'product_name' => $product_name,
            'price' => $price
        ];

        return view('products.show', $data);
    }
}
