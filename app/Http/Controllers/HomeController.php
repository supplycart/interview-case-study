<?php

namespace App\Http\Controllers;

use App\Models\Item;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'items' => Item::all(),
        ]);
    }
}
