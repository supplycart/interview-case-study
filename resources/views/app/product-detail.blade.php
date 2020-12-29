@extends('layouts.app')
@section('content')
<div class="flex justify-center my-6">
  <div class="container px-5 py-24 mx-auto">
    <div class="lg:w-4/5 mx-auto flex flex-wrap">
      <img src= "{{ $product->picture }}">
      <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
        <h2 class="text-sm title-font text-gray-500 tracking-widest">{{ $product->brand->name }}</h2>
        <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $product->name }}</h1>
        @if ($product->description)
            <p class="leading-relaxed">{{ $product->description }}</p>
        @else
            <p class="leading-relaxed italic">No product description was provided</p>
        @endif

        <div class="flex">
          <span class="title-font font-medium text-2xl text-gray-900">${{ $product->price }}</span>
          <form method="POST" action="{{ route('add-product-to-cart', ['product' => $product->id]) }}">
              @csrf
              <button class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                Add to cart
              </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection