<?php

namespace App\Livewire;

use App\Models\OrderItems;
use App\Models\Orders;
use Livewire\Component;

class OrderView extends Component
{
    public $order;

    public $orderItems;

    public function mount($orderId)
    {
        $this->order = Orders::where('id', $orderId)->first();

        $this->orderItems = OrderItems::with('product')
                            ->where('order_id', $orderId)
                            ->get();
       
    }
    public function render()
    {
        return view('livewire.order-view');
    }
}
