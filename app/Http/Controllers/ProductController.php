<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Product/Index');
    }

    public function show($id)
    {
        return Inertia::render('Product/Show', [
            'id'    => $id
        ]);
    }
}
