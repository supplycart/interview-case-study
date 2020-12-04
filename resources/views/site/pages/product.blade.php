@extends('site.app')
@section('title', $product->name)
@section('content')
    <div class="container mx-auto px-6">
        <div class="md:flex md:items-center">
            <div class="w-full h-64 md:w-1/2 lg:h-96">
                <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="https://images.unsplash.com/photo-1508423134147-addf71308178?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80" alt="{{$product->name}}">
            </div>
            <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
                <h3 class="text-gray-700 uppercase text-lg">{{$product->getName()}}</h3>
                <span class="text-gray-500 mt-3">RM{{ $product->getPrice() }}</span>
                <hr class="my-3">
                <form action="{{ route('product.add.cart') }}" method="POST" role="form" id="addToCart">
                    @csrf
                    <div class="mt-2">
                        <label class="text-gray-700 text-sm">Available Quantity: {{$product->getQuantity()}}</label>
                        <input type="hidden" name="productId" value="{{ $product->getKey() }}">
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Quantity:</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="number" name="quantity" id="quantity" min="0" max="{{$product->getQuantity()}}" class="focus:ring-indigo-500 focus:border-indigo-500 border-2 block w-1/5 pl-7 pr-12 sm:text-sm border-gray-300 rounded-md">
                            <input type="hidden" name="productId" value="{{ $product->getKey() }}">
                            <input type="hidden" name="price" id="price" value="{{ $product->getPrice()}}">
                        </div>
                    </div>
                    @include('site.partials.flash')
                    @if($product->getQuantity() === 0)
                        <p>out of stock</p>
                    @else
                    <div class="flex items-center mt-6">
                        <button class="mx-2 text-gray-600 border rounded-md p-2 hover:bg-gray-200 focus:outline-none">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </button>
                    </div>
                    @endif
                </form>

            </div>
        </div>
        <div class="mt-16">
        </div>
    </div>
@endsection

@push('scripts')
    <style>
        input[type='number']::-webkit-inner-spin-button,
        input[type='number']::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .custom-number-input input:focus {
            outline: none !important;
        }

        .custom-number-input button:focus {
            outline: none !important;
        }
    </style>

    <script>
        function decrement(e) {
            const btn = e.target.parentNode.parentElement.querySelector(
                'button[data-action="decrement"]'
            );
            const target = btn.nextElementSibling;
            let value = Number(target.value);
            value--;
            target.value = value;
        }

        function increment(e) {
            const btn = e.target.parentNode.parentElement.querySelector(
                'button[data-action="decrement"]'
            );
            const target = btn.nextElementSibling;
            let value = Number(target.value);
            value++;
            target.value = value;
        }

        const decrementButtons = document.querySelectorAll(
            `button[data-action="decrement"]`
        );

        const incrementButtons = document.querySelectorAll(
            `button[data-action="increment"]`
        );

        decrementButtons.forEach(btn => {
            btn.addEventListener("click", decrement);
        });

        incrementButtons.forEach(btn => {
            btn.addEventListener("click", increment);
        });
    </script>
@endpush

