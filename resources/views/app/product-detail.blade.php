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
          <a
            class="flex ml-auto text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded"
            href={{ route('cart') }}
        >
            <button>Button</button>
          </a>
          <button class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
              <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection