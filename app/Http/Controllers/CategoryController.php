<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $id)
    {
        return Inertia::render('Category', [
            'category_name' => Category::find($id),
            'category_by_id' => Product::where('Category', $id)->get()
        ]);
    }

}
