@extends('layouts.app')

@section('title', 'My Orders')
@section('header', 'Order History')

@section('content')
@if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if ($orders->isNotEmpty())
    <table class="table-auto w-full bg-white shadow rounded">
        <thead>
            <tr>
                <th class="px-4 py-2">Order ID</th>
                <th class="px-4 py-2">Total Price</th>
                <th class="px-4 py-2">Order Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td class="border px-4 py-2">{{ $order->id }}</td>
                    <td class="border px-4 py-2">${{ number_format($order->total_price, 2) }}</td>
                    <td class="border px-4 py-2">{{ $order->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>You have no orders.</p>
@endif
@endsection
