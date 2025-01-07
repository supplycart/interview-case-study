@extends('layouts.app')

@section('title', 'Cart')
@section('header', 'Your Cart')

@section('content')
@if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if (!empty($cart))
    <table class="table-auto w-full bg-white shadow-md rounded-lg">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2">Product Name</th>
                <th class="px-4 py-2">Price</th>
                <th class="px-4 py-2">Quantity</th>
                <th class="px-4 py-2">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $id => $item)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $item['name'] }}</td>
                    <td class="px-4 py-2">${{ number_format($item['price'], 2) }}</td>
                    <td class="px-4 py-2">{{ $item['quantity'] }}</td>
                    <td class="px-4 py-2">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p class="font-bold mt-4">Total: ${{ number_format(collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']), 2) }}</p>
    <br>

    <div class="flex space-x-4">
        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Clear Cart
            </button>
        </form>
    
        <form action="{{ route('order.place') }}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Place Order
            </button>
        </form>
    </div>
    
@else
    <p>Your cart is empty.</p>
@endif
@endsection
