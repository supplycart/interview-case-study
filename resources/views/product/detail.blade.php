@extends('layouts.app')

@section('content')
    <section class="text-gray-700 body-font overflow-hidden bg-white">
        <div class="container px-5 py-24 mx-auto">

            @if(session()->has('success'))
                <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
                <span class="inline-block align-middle mr-8">
                    {{ session()->get('success') }}
                </span>
                </div>
            @endif

            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <img alt="ecommerce" class="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200" src="{{ $product->image_src }}">
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    {{--<h2 class="text-sm title-font text-gray-500 tracking-widest">BRAND NAME</h2>--}}
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $product->name }}</h1>
                    <p class="leading-relaxed">
                        {{ $product->description }}
                    </p>
                    <form class="w-full" method="POST" action="{{ route('cart.add', [$product]) }}">
                        @csrf
                        <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5">
                            <div class="flex ml-6 items-center">
                                <span class="mr-3">Quantity</span>
                                <div class="relative">
                                    <input type="number" class="rounded border appearance-none border-gray-400 py-2 focus:outline-none focus:border-green-500 text-base pl-3 pr-3 w-24" value="1"
                                           min="1" name="quantity" required/>
                                    @error('quantity')
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="flex">
                            <span class="title-font font-medium text-2xl text-gray-900">MYR {{ $product->product_price }}</span>
                            <button type="submit" class="flex ml-auto text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded">Add to Cart</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
