@extends('app')

@section('title', 'Order')

@section('content')
    <div class="container px-6 mx-auto">
        <h3 class="text-2xl px-8 font-medium text-gray-700">Order History</h3>
        @if ($message = Session::get('success'))
            <div class="py-4 px-8 my-4 bg-green-400 rounded">
                <p class="text-green-800">{{ $message }}</p>
            </div>
        @endif
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full">
                @foreach ($ordersProducts as $order => $products)
                <div class="mt-4 mb-4 px-8">
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
    </div>
@endsection