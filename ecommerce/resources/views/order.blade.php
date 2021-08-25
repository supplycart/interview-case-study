@extends('app')

@section('title', 'Order')

@section('content')
    <main class="container mx-auto p-6">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <h3 class="text-3xl text-bold">Order History</h3>
            <div class="w-full">
                @foreach ($ordersProducts as $order => $products)
                <div class="mt-4 mb-4">
                    <h1 class="px-4 py-3 text-blue-500">Order ID: {{ $order }}</h1>
                    <table class="w-full">
                        <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Price</th>
                                <th class="px-4 py-3">Quantity</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($products as $product)  
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 border">{{ $product->name }}</td>
                                <td class="px-4 py-3 border">${{ $product->price }}</td>
                                <td class="px-4 py-3 border">{{ $product->quantity }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h1 class="px-4 py-3 text-red-500">Total: ${{ $products[0]->total }}</h1>
                </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection