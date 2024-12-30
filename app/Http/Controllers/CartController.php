<?php

namespace App\Http\Controllers;

use App\CartStatus;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\ProductVariation;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        $validatedData = $request->validate([
            'product_variation_id' => 'required|integer|exists:product_variations,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getCurrentCart();
        $item = $cart->items()->where('product_variation_id', $validatedData['product_variation_id'])->first();

        if (!$item) {
            $cart->items()->create($validatedData);
        } else {
            $item->quantity = $item->quantity + $validatedData['quantity'];
            $item->save();
        }

        return redirect()->back();
    }

    public function show()
    {
        return Inertia::render('Cart/Show', [
            ...$this->getCartSummary(),
        ]);
    }

    public function updateQuantity(Request $request)
    {
        $validatedData = $request->validate([
            'cart_item_id' => 'required|integer|exists:cart_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getCurrentCart();

        $cartItem = $cart->items->findOrFail($validatedData['cart_item_id']);
        $cartItem->quantity = $validatedData['quantity'];
        $cartItem->save();

        return redirect()->back();
    }

    public function showCheckout()
    {
        return Inertia::render('Cart/Checkout', [
            ...$this->getCartSummary(),
        ]);
    }

    public function checkout(Request $request)
    {
        // validate
        $validatedData = $request->validate([
            'contact_name' => 'required|max:255',
            'contact_number' => ['required', 'regex:/^6?0?(1[15]?\d{8}|[4-79]\d{7}|8[2-9]\{6}|3\d{8})$/'],
            'address' => 'required|max:255',
            'postcode' => 'required|digits:5',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'remarks' => 'sometimes',
            'cardholder_name' => 'required',
            'card_number' => [
                'required',
                'regex:/^[0-9]{13,19}$/', // Accepts only numbers with 13 to 19 digits
            ],
            'card_expiry' => [
                'required',
                'regex:/^(0[1-9]|1[0-2])\/\d{4}$/', // Validates MM/YYYY format
            ],
            'card_cvv' => 'required|numeric|digits:3',
        ]);


        $summary = $this->getCartSummary();
        $cart = $summary['cart'];
        $checkoutSummary = $summary['checkout_summary'];
        $user = auth()->user();

        DB::transaction(function () use ($user, $cart, $checkoutSummary, $validatedData) {
            // Update cart status
            $cart->status = CartStatus::CHECKOUT_COMPLETED->value;
            $cart->save();
            $order = $user->orders()->create([
                ...$validatedData,
                ...$checkoutSummary,
            ]);

            $orderItems = [];
            foreach ($cart->items as $item) {
                $orderItems[] = [
                    'product_variation_id' => $item->product_variation_id,
                    'product_name' => $item->productVariation->product->name,
                    'variation_name' => $item->productVariation->name,
                    'price' => $item->productVariation->price,
                    'quantity' => $item->quantity,
                    'image' => $item->productVariation->image,
                ];
            }

            $order->items()->createMany($orderItems);

            // Update cart status
            $cart->status = CartStatus::CHECKOUT_COMPLETED->value;
            $cart->save();
        });



        // redirect to order history
        return redirect()->route('order.index');
    }

    public function deleteCartItem(Request $request)
    {
        $validatedData = $request->validate([
            'cart_item_id' => 'required|integer|exists:cart_items,id',
        ]);

        $cart = $this->getCurrentCart();

        $cartItem = $cart->items->findOrFail($validatedData['cart_item_id']);
        $cartItem->delete();

        return redirect()->back();
    }

    private function getCurrentCart()
    {
        $user = auth()->user();
        $cart = $user->carts()->where('status', CartStatus::PENDING_CHECKOUT->value)->first();

        if (!$cart) {
            $cart = $this->createCart();
        }

        return $cart->loadMissing('items.productVariation.product');
    }

    private function createCart()
    {
        $user = auth()->user();
        return $user->carts()->create();
    }

    private function getCartSummary()
    {
        $cart = $this->getCurrentCart();

        // calculate grand total
        $grandTotal = $cart->items->sum(function ($item) {
            return $item->productVariation->price * $item->quantity;
        });

        // calculate discount
        $discount = 0; // no discount implementation yet

        // calculate discounted price
        $discountedPrice = $grandTotal - $discount;

        $tax = $discountedPrice * 0.06;

        $netPrice = $discountedPrice + $tax;

        return [
            'cart' => $cart,
            'checkout_summary' => [
                'grand_total' => $grandTotal,
                'discount' => $discount,
                'tax' => $tax,
                'net_price' => $netPrice,
            ],
        ];
    }
}
