<?php

namespace App\Livewire;

use App\Models\Carts;
use App\Services\CartServices;
use App\Services\CheckoutServices;
use Livewire\Component;
use Filament\Notifications\Notification;

class CartManagement extends Component
{
    public $carts = [];
    public $subtotal = 0;
    protected $listeners = ['cartUpdated' => 'refreshCart'];
    
    protected $cartServices;
    protected $checkoutServices;

    public function boot(CartServices $cartServices, CheckoutServices $checkoutServices)
    {
        $this->cartServices = $cartServices;
        $this->checkoutServices = $checkoutServices;
    }

    public function mount()
    {
        $this->refreshCart();
    }

    #[On('cartUpdated')] 
    public function refreshCart()
    {
        if (auth()->check()) {
            $this->carts = $this->cartServices->getCartItem();
            $this->subtotal = $this->cartServices->calculateCartSubTotal();
        }
    }

    public function removeQuantity($cartId)
    {
     
        $cart = Carts::where('user_id', auth()->id())
            ->find($cartId);

        if (!$cart) {
            return Notification::make()
                ->title('Item Not Found')
                ->body('Whoops! the product are not found in your cart.')
                ->icon('heroicon-o-document-text')
                ->iconColor('danger')
                ->send();
        }

        if ($cart->quantity > 1) {
            // Directly update quantity on databse
            $cart->decrement('quantity');
        } else {
            // Remove the items from the cart if quantity 0
            $cart->delete(); 
        }

        // Directly update stock quantity on database
        $cart->product->increment('stock_quantity');

        $this->dispatch('cartUpdated');

        return Notification::make()
            ->title('Remove Item')
            ->icon('heroicon-o-trash')
            ->iconColor('info')
            ->send();
    }

    public function checkoutOrder()
    {
        $this->checkoutServices->placeOrder($this->carts, $this->subtotal);

        $this->dispatch('cartUpdated');
        
        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.cart-management');
    }
}
