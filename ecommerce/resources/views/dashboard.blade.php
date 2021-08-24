@extends('app')

@section('title', 'Shop')

@section('content')
    <div class="container px-6 mx-auto">
        <h3 class="text-2xl font-medium text-gray-700">Product List</h3>
        <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($products as $product)
            <div class="w-full max-w-sm mx-auto overflow-hidden rounded-md shadow-md">
                <img src="{{ url($product->image) }}" alt="" class="w-full h-60">
                <div class="px-5 py-3">
                    <h1 class="text-black-700 bold">{{ $product->name }}</h1>
                    <span class="mt-2 text-gray-500">${{ $product->price }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection