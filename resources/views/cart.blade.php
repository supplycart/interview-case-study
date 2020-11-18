@extends('layouts.app')

@section('content')
<main class="my-8">
    <div class="container mx-auto px-6">
        <h3 class="text-gray-700 text-2xl font-medium text-center">Shopping Cart</h3>
        <!-- modified from https://codepen.io/abdelrhman/pen/BaNPVJO?editors=1000 -->
        <div class="flex shadow-md my-10">
            <div class="w-full bg-white px-10">
                <div class="flex mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Name</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
                </div>
                @forelse  ($cart as $product)
                <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                    <div class="flex w-2/5">
                        <!-- product -->
                        <div class="w-20">
                            <img class="object-contain w-full h-20" src="{{$product->image_path}}" alt="">
                        </div>
                        <div class="flex flex-col justify-between ml-4 flex-grow">
                            <span class="font-bold text-sm">{{$product->name}}</span>
                            <a href="#" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</a>
                        </div>
                    </div>
                    <div class="flex justify-center w-1/5">
                        <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512">
                            <path d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                        </svg>

                        <input class="mx-2 border text-center w-8" type="text" value="{{$product->qty}}" disabled>

                        <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512">
                            <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                        </svg>
                    </div>
                    <span class="text-center w-1/5 font-semibold text-sm">RM {{number_format($product->price, 2)}}</span>
                    <span class="text-center w-1/5 font-semibold text-sm">RM {{number_format($product->total, 2)}}</span>
                </div>
                @empty
                    <p class="font-bold text-2xl text-center">No items in cart.</p>
                @endforelse
                <a href="/shop" class="flex font-semibold text-sm text-blue-600 mt-8 mb-8">
                    Continue Shopping
                </a>
                @if(!empty($cart))
                <div class="border-t mt-8">
                    <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                        <span>Total cost</span>
                        <span>RM {{number_format($total, 2)}}</span>
                    </div>
                    <button onclick="location.href='/checkout';" class="bg-blue-500 font-semibold hover:bg-blue-600 py-3 text-sm text-white uppercase w-full m-3">Checkout</button>
                </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection