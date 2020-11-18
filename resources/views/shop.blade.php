@extends('layouts.app')

@section('content')
<main class="my-8">
    <div class="container mx-auto px-6">
        <h3 class="text-gray-700 text-2xl font-medium text-center">Shop </h3>

        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 mt-6">
            @foreach ($products as $product)
            <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                <div class="flex items-end justify-end h-56 w-full">
                    <img class="object-cover w-full h-full" src="{{$product->image_path}}" />
                </div>
                <div class="px-5 py-3">

                    <h3 class="text-gray-900 uppercase truncate">{{$product->name}}</h3>
                    <span class="text-gray-700 mt-2">RM {{number_format($product->price, 2)}}</span>
                    
                    <p class="text-gray-600 font-light truncate"> {{$product->description }}</p>

                    <button @click="addToCart({{$product->id}})" class="w-full mt-3 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded inline-flex items-center justify-center">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span>Add to Cart</span>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>
@endsection