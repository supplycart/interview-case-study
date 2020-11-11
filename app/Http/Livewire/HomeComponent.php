<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Product;

class HomeComponent extends Component
{
    public function render()
    {	
    	$cartAmount = 2;
    	$id_name = '';

    	if(Auth::user() == null){
    		$cartAmount = 0;
    	}else{
    		$user = Auth::user();
    		$id_name = $user->id.'_'.$user->name;
    	}

    	$category_arr = Category::select(['id','name'])->get();
    	$product_arr = json_decode(Product::getAllProducts());

        return view('livewire.home-component')->layout('layouts.base',['cartAmount' => $cartAmount, 'userIdName' => $id_name, 'categories' => $category_arr, 'products' => $product_arr]);
    }
}
