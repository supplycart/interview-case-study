@extends('layouts.app')

@section('title', 'Products')
@section('header', 'Product List')

@section('content')

@if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($products as $product)
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
            <p class="text-gray-600">{{ $product->description }}</p>
            <p class="text-blue-600 font-bold">${{ number_format($product->price, 2) }}</p>
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add to Cart</button>
            </form>
        </div>
    @endforeach
</div>
@endsection
