<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\CartRepositoryInterface;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\SyncCartRequest;
use App\Models\Cart;
use Inertia\Inertia;

class CartController extends Controller
{
    protected CartRepositoryInterface $cartRepo;

    public function __construct(CartRepositoryInterface $cartRepo) 
    {
        $this->cartRepo = $cartRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = $this->cartRepo->getUserCart(auth()->id());

        return Inertia::render('Cart', [
            'cartItems' => $cartItems,
        ]);

    }

    public function show()
    {
        return response()->json(
            $this->cartRepo->getUserCart(auth()->id())
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        $cart = $this->cartRepo->addOrUpdate(
                    auth()->id(),
                    $request->product_id,
                    $request->qty
                );

        activity()
            ->causedBy(auth()->user())
            ->performedOn($cart)
            ->withProperties(['product_id' => $request->product_id, 'qty' => $request->qty])
            ->log('Added product to cart');


        return response()->json(['message' => 'Cart synced']);
    }

    public function destroy($product_id)
    {
        $this->cartRepo->deleteFromCart(auth()->id(), $product_id);

        return response()->json(['message' => 'Cart item removed']);
    }


    public function sync(SyncCartRequest $request)
    {
        $this->cartRepo->bulkSync(auth()->id(), $request->validated()['items']);

        return response()->json(['message' => 'Cart synced']);
    }

}
