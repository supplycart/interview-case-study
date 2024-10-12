<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    // Return the cart for the authenticated user
    public function index(Request $request)
    {
        // Get the cart for the authenticated user
        $cart = Cart::with('items.product', 'items.product.brand')->where('user_id', Auth::id())->first();

        // Get the selected item IDs from the request (array of product IDs)
        $selectedItemIds = $request->input('selected_items', []);

        // If the cart is not found, return an empty cart structure
        if (!$cart) {
            return response()->json([
                'id' => null,
                'user_id' => Auth::id(),
                'items' => [],
                'total_price' => 0.00
            ]);
        }

        $totalPrice = 0;

        // Loop through the cart items
        foreach ($cart->items as $item) {
            // Calculate the subtotal for each item (price * quantity)
            $item->subtotal = round($item->product->price * $item->quantity, 2);

            // If the item is selected, include it in the total price calculation
            if (in_array($item->product_id, $selectedItemIds)) {
                $totalPrice += $item->subtotal;
            }
        }

        // Set the total price for the selected items
        $cart->total_price = round($totalPrice, 2);

        return response()->json($cart);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate product ID and quantity
        $validatedData = $request->validate([
            'product_id' => 'required|integer|exists:products,id', // Ensure the product ID exists
            'quantity' => 'required|integer|min:0', // Quantity must be an integer and >= 0
        ]);

        $userId = Auth::id();
        $productId = $validatedData['product_id'];
        $quantity = $validatedData['quantity'];

        // Find or create a cart for the user
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // Check if the product is already in the cart
        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $productId)
                            ->first();

        if ($cartItem) {
            // If the product is already in the cart, update the quantity
            $cartItem->quantity += $quantity;

            // If the quantity is 0 or less, remove the item from the cart
            if ($cartItem->quantity <= 0) {
                $cartItem->delete();
                return response()->json(['message' => 'Product removed from cart.'], 200);
            }
        } else {
            // If the product is not in the cart, and the quantity is positive, create a new cart item
            if ($quantity > 0) {
                $cartItem = new CartItem();
                $cartItem->cart_id = $cart->id;
                $cartItem->product_id = $productId;
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        }

        $cartItem->save();

        return response()->json(['message' => 'Cart updated successfully.'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productId)
    {
        //
    }
}
