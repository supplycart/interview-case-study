<div>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-6">
    <div class="w-full max-w-2xl bg-white shadow-xl rounded-lg overflow-hidden">
        <div class="px-4 py-6 sm:px-6">
        <div class="flex items-start justify-between">
            <h2 class="text-lg font-medium text-gray-900" id="drawer-title">Product cart</h2>
            <div class="ml-3 flex h-7 items-center">
            <button type="button" class="relative -m-2 p-2 text-gray-400 hover:text-gray-500">
                <span class="absolute -inset-0.5"></span>
                <span class="sr-only">Close panel</span>
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
            </div>
        </div>
        @if ($carts->isNotEmpty())
            <div class="mt-8">
                <div class="flow-root">
                <ul role="list" class="-my-6 divide-y divide-gray-200">
                    @foreach ($carts as $cart)
                        <!-- Product -->
                        <li class="flex py-6">
                        <div class="size-24 shrink-0 overflow-hidden rounded-md border border-gray-200">
                            <img src="{{ asset('images/product.png') }}" alt="Salmon orange fabric pouch" class="size-full object-cover" />
                        </div>

                        <div class="ml-4 flex flex-1 flex-col">
                            <div class="flex justify-between text-base font-medium text-gray-900">
                            <h3><a href="#">{{$cart->product->code}}</a></h3>
                            <p class="ml-4">RM {{$cart->product->price}}</p>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">{{ $cart->product->name}}</p>
                            <div class="flex flex-1 items-end justify-between text-sm">
                            <p class="text-gray-500">Qty {{$cart->quantity}}</p>
                            <div class="flex">
                                <button type="button" wire:click="removeQuantity({{ $cart->id }})" class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
                            </div>
                            </div>
                        </div>
                        </li>
                    @endforeach
                </ul>
                </div>
            </div>
            </div>

            <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
            <div class="flex justify-between text-base font-medium text-gray-900">
                <p>Subtotal</p>
                <p wire:model="subtotal">RM {{ number_format($subtotal, 2) }}</p>
            </div>
            <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
            <div class="mt-6 flex justify-center">
                <button wire:click="checkoutOrder" class="flex items-center justify-center rounded-md bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">
                    Checkout
                </button>
            </div>
            <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                <p>
                or
                <a href="{{ route('product') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Continue Shopping
                </a>
                </p>
            </div>
            </div>
        @else
            <div class="flex flex-col items-center py-12 text-gray-500 text-lg">
                <img src="{{ asset('images/product.png') }}" alt="Empty cart" class="w-24 h-24 mb-4" />
                <p class>Your haven't added anything to your cart!</p>
                <a href="{{ route('product') }}" class="flex items-center justify-center rounded-md bg-success-600 mt-4 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-success-600">
                    Browse
                </a>
            </div>
        @endif
    </div>
    </div>

</div>