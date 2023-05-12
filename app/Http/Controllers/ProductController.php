<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Models\Activity;
use App\Models\Product;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $data['products'] = Product::all();
        return Inertia::render('Product/Index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Product/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request) {
                $product = new Product();
                $product->name = $request->name;
                $product->price = $request->price;
                $product->image = $request->file('image')->store('products');
                $product->save();

                Activity::create([
                    'user_id' => Auth::id(),
                    'action' => 'store',
                    'module' => 'product',
                    'description' => 'new product with ID '.$product->id.' added',
                ]);
            });

            return Redirect::to('/dashboard')->with('success', 'Product added.');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return Redirect::to('/dashboard')->with('error', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
