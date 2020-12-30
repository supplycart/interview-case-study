@extends('layouts.app')
@section('content')
<div class="flex justify-center my-6">
  <div class="container px-5 py-24 mx-auto">
    <div class="lg:w-4/5 mx-auto flex flex-wrap">
      <img src= "{{ $product->picture }}">
      <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
        <h2 class="text-sm title-font text-gray-500 tracking-widest">{{ $product->brand->name }}</h2>
        <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $product->name }}</h1>
        <div class="flex items-center space-x-4 my-4">
          <div>
            <div class="rounded-lg bg-gray-100 flex py-2 px-3">
              <span class="text-indigo-400 mr-1 mt-1">$</span>
              <span class="font-bold text-indigo-600 text-3xl">{{ $product->price }}</span>
            </div>
          </div>
        </div>
        @if ($product->description)
            <p class="leading-relaxed">{{ $product->description }}</p>
        @else
            <p class="leading-relaxed italic">No product description was provided</p>
        @endif

        <div class="flex">
          <div class="flex py-4 space-x-4">
            <div class="relative">
              @if($product->quantity > 0)
              <form method="POST" action="{{ route('add-product-to-cart', ['product' => $product->id]) }}">
                @csrf
                <div class="text-center left-0 pt-2 right-0 absolute block text-xs uppercase text-gray-400 tracking-wide font-semibold">Qty</div>
                  <select name="product_quantity" class="rounded-xl border border-gray-200 pl-4 pr-8 h-14 flex pb-1">
                    @for ($i = 1; $i < $product->quantity + 1; $i++)
                    <option value="{{ $i }}"> {{ $i }} </option>
                    @endfor
                  </select>
                </div>
              <button type="submit" class="h-14 px-6 py-2 font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white">
                Add to Cart
              </button>
            </form>
            @else
            <p> Out of stock :( </p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection