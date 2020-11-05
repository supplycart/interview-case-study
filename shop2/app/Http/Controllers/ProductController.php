<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Storage;
use File;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $subcategories = Subcategory::get();
        return view('product.create')->with('categories',$categories)
                                    ->with('subcategories',$subcategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'price' => 'required|numeric|max:9999',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $product = new Product();
        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->shortdescription = $request['prodesc'];
        $product->category_id = $request['category_id'];
        $product->subcategory_id = $request['subcategory_id'];
        $image = $request['image'];
        $extension = $image->getClientOriginalExtension();
        $name = time().'_'.$image->getClientOriginalName();
        $image->move(public_path('/images'),$name);
        // Storage::disk('public')->put($name, File::get($image));
        $product->img = $name;

        $product->save();


        /*
        $product = new Product();
        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->shortdescription = $request['prodesc'];
        $product->category_id = $request['category_id'];
        $product->subcategory_id = $request['subcategory_id'];
        if($request['image']){
            $image = $request['image'];
            $extension = $image->getClientOriginalExtension();
            $name = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('/images'),$name);

            $product->img = $image;
        }else{
            $product->img = 'default.png';
        }

        $product->save();*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
