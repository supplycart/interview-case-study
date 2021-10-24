@extends('app')

@section('content')
    <div class="h-full">
        <section class="header relative">
            <div class="bg-no-repeat bg-cover bg-center w-full" style="background-image:url({{ asset('images/header.jpg') }}); height: 500px"></div>
            <div class="bg-black w-full absolute top-0 left-0 opacity-20" style="height:500px"></div>
        </section>
        <div class="container mx-auto mt-12">
            @if (session()->has('success'))
            <div id="alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
            {{-- <strong class="font-bold">Holy smokes!</strong> --}}
            <span class="block sm:inline">{{ session()->get('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <button onclick="closeAlert()"><svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg></button>
            </span>
            </div>
            @endif
            <div class="flex shadow-sm my-10">
            <div class="w-3/4 bg-white px-10 py-10">
                <div class="flex justify-between border-b pb-8">
                <h1 class="font-semibold text-2xl">Shopping Cart</h1>
                <h2 class="font-semibold text-2xl">
                    @if (Session::get('cart') !== null)
                    {{ count(Session::get('cart')) }}
                    @else
                    0
                    @endif
                     Item(s)</h2>
                </div>
                <div class="flex mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
                </div>
                @php $total = 0 @endphp
                @if (!empty($data))
                    @foreach ($data as $key => $product)
                    <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                    <div class="flex w-2/5">
                        <div class="w-20">
                        <img class="h-24 object-cover object-center" src="{{ asset('images/products/' . $product["image"]) }}" alt="">
                        </div>
                        <div class="flex flex-col justify-between ml-4 flex-grow">
                        <span class="font-bold text-sm">{{ $product["name"] }}</span>
                        <span class="text-red-500 text-xs">{{ ucfirst($product["brand"]) }}</span>
                        <a href="{{ route('delete-item', $key)}}" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</a>
                        </div>
                    </div>
                    <div class="flex justify-center w-1/5">
                        {{ $product["quantity"] }}
                    </div>
                    <span class="text-center w-1/5 font-semibold text-sm">RM{{ number_format($product["price"], 2) }}</span>
                    <span class="text-center w-1/5 font-semibold text-sm">RM{{ number_format($product["price"] * $product["quantity"], 2) }}</span>
                    </div>
                    @php $total += $product["price"] * $product["quantity"] @endphp
                    @endforeach
                @else
                    <span class="text-gray-400 italic">You do not have any items in your cart..</span>
                @endif

                <a href="{{ route('dashboard') }}" class="flex font-semibold text-indigo-600 text-sm mt-10">
                    <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                        <path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/>
                    </svg>
                    Continue Shopping
                </a>
            </div>

            <div id="summary" class="w-1/4 px-8 py-10" style="background: #f6f6f6">
                <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
                <div class="flex justify-between mt-10">
                    <span class="font-semibold text-sm uppercase mb-5">TOTAL</span>
                    <span class="font-semibold text-sm">RM{{ number_format($total, 2) }}</span>
                </div>
                <div class="flex justify-between mb-5">
                    <span class="font-semibold text-sm uppercase mb-5">TAX (6%)</span>
                    <span class="font-semibold text-sm">RM{{ number_format($total * 0.06, 2) }}</span>
                </div>
                <div class="border-t">
                <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                    <span>Total cost</span>
                    <span>RM{{ number_format($total + $total * 0.06, 2)  }}</span>
                </div>
                <a href="{{ route('delete-cart') }}">
                    <button class="bg-red-500 font-semibold hover:bg-red-600 py-3 text-sm text-white uppercase w-full mb-2">Clear</button>
                </a>
                <a href="{{ route('add-order') }}">
                    <button class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Checkout</button>
                </a>
                </div>
            </div>

            </div>
        </div>
    </div>
@endsection