<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return DB::table('carts')
            ->join('items', 'items.id', '=', 'carts.item_id')
            ->where('user_id', '=', auth()->id())
            ->get();
    }

    public function store()
    {
        $data = request()->validate([
            'item_id' => 'required',
            'quantity' => '',
        ]);

        $currentItem = auth()->user()->carts()->where('item_id', '=', $data['item_id']);

        if (count($currentItem->get()) > 0) {
            isset($data['quantity'])
                ? $currentItem->update(['quantity' => $data['quantity']])
                : $currentItem->increment('quantity');
            return;
        }

        Cart::create(
            [
                'user_id' => auth()->id(),
                'item_id' => $data['item_id'],
                'quantity' => 1,
            ]
        );
    }

    public function update($item)
    {
        $data = request()->validate([
            'mode' => 'required', // mode 0: increment // mode 1: decrement
        ]);

        $currentItem = auth()->user()->carts()->where('item_id', '=', $item);

        if ($data['mode'] == 0 && $currentItem->get('quantity')[0]->quantity < 20) {
            $currentItem->increment('quantity');
        }

        if ($data['mode'] == 1 && $currentItem->get('quantity')[0]->quantity > 1) {
            $currentItem->decrement('quantity');
        }
    }

    public function delete($item)
    {
        auth()->user()->carts()->where('item_id', '=', $item)->delete();
    }
}
