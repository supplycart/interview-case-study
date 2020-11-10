@extends('layouts.app')

@section('content')
<h3 class="text-center">Order History</h3><br/>
<div class="flex justify-center h-screen">
    <table class="table-auto">
        <thead class="bg-orange-900 text-gray-100 space-y-3">
            <tr>
                <th class="px-4 py-2">Product</th>
                <th class="px-4 py-2">SubTotal</th>
                <th class="px-4 py-2">Order At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td class="border  divide-y divide-gray-400">
                    @foreach ($order->carts as $cart)
                    <div class="px-4 py-2 space-y-3">
                    <p class="text-gray-700 font-semibold"> {{$loop->index+1}}. {{$cart->product->name}}</p>
                    <p class="text-gray-700 uppercase font-semibold">RM {{$cart->subtotal}}  X {{$cart->quantity}} </p>
                    <p><b>Total: RM {{$cart->subtotal}}</b></p>
                    </div>
                    @endforeach
                </td>
                <td class="border px-4 py-2 text-gray-800 font-bold">RM {{$order->total}}</td>
                <td class="border px-4 py-2">{{ $order->created_at->format('d/M/Y h:i:s a')}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
