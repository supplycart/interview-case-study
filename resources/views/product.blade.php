@extends('layouts.main')

@section('title', 'Products')
  
@section('content')

<div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
  <nav id="store" class="w-full z-30 top-0 px-6 py-1">
      <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
        <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
          Store
        </a>
      </div>
  </nav>
  @forelse($products as $row)
  <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col max-h-full">
    @if (empty($row->image))
      <img class="hover:grow hover:shadow-lg" src="https://images.unsplash.com/photo-1555982105-d25af4182e4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80">
    @else
      <img class="hover:grow hover:shadow-lg" src="{{ asset('storage/products/' . $row->image ) }}">
    @endif
    <div class="pt-3 flex items-center justify-between">
      <h1 class="flex-none font-semibold mb-2.5">
        {{ $row->name }}
      </h1>
      <p class="text-4xl font-bold text-purple-600">
        $ {{ $row->price }}
      </p>   
    </div>
    <p class="w-full flex-none font-thin my-1">
      {{ $row->description }}
    </p>       
    <form action="{{ route('addToCart') }}" method="POST">
      @csrf
      <div class="flex space-x-3 mb-4 text-sm font-semibold">
        <button class="mt-4 inline-flex items-center justify-center px-4 py-2 text-base leading-5 rounded-md border font-medium shadow-sm transition ease-in-out duration-150 focus:outline-none focus:shadow-outline bg-blue-600 border-blue-600 text-gray-100 hover:bg-blue-500 hover:border-blue-500 hover:text-gray-100">
          <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M21,7H7.462L5.91,3.586C5.748,3.229,5.392,3,5,3H2v2h2.356L9.09,15.414C9.252,15.771,9.608,16,10,16h8 c0.4,0,0.762-0.238,0.919-0.606l3-7c0.133-0.309,0.101-0.663-0.084-0.944C21.649,7.169,21.336,7,21,7z M17.341,14h-6.697L8.371,9 h11.112L17.341,14z" />
            <circle cx="10.5" cy="18.5" r="1.5" />
            <circle cx="17.5" cy="18.5" r="1.5" />
          </svg>
          <input type="hidden" name="product_id" value="{{ $row->id }}" class="form-control">
          <input type="hidden" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700 outline-none">
          Add to cart
        </button>
      </div>
    </form>  
  </div>
@empty
  <p> No Data Available </p>                 
@endforelse

@endsection