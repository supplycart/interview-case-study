<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;

class MainController extends Controller
{
    public function mainLogin() {
        return view('auth.login');
    }

    public function mainHome() {
        $product = Product::all();
        $count_watch = count($product);
        return view('home', compact('product', 'count_watch'));
    }

    public function test()
    {
        dd('what');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
