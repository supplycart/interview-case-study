<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class CartController
 * @package App\Http\Controllers
 * @author Haze Illias <hazreenaaida@gmail.com>
 */

class CartController extends Controller
{
    public function getCart()
    {
        return view('site.pages.cart');
    }

    public function removeItem($id)
    {

        if($product = Product::find(Cart::get($id)->attributes['productId'])) {
            $product->quantity = $product->getQuantity() + Cart::get($id)->quantity;
            $product->save();
        }
        Cart::remove($id);

        if (Cart::isEmpty()) {
            return redirect('/');
        }
        return redirect()->back()->with('message', 'Item removed from cart successfully.');
    }
}
