@extends('app')

@section('title', 'Cart')

@section('content')
    <div class="container px-6 mx-auto">
        <h3 class="text-2xl px-8 font-medium text-gray-700">Cart</h3>
        @if ($message = Session::get('success'))
            <div class="py-4 px-8 my-4 bg-green-400 rounded">
                <p class="text-green-800">{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="py-4 px-8 my-4 bg-red-400 rounded">
                <p class="text-red-800">{{ $message }}</p>
            </div>
        @endif
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full pt-4 mt-4 mb-4 px-8">
            <table class="w-full">
                <thead>
                    <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">Image</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Quantity</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Remove </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($cartItems as $item)
                    <tr>
                        <td class="px-4 py-3 border">
                            <img src="{{ $item->attributes->image }}" class="w-20 h-20 rounded" alt="Thumbnail">
                        </td>
                        <td class="px-4 py-3 border">{{ $item->name }}</td>
                        <td class="px-4 py-3 border">
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id}}" >
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" class="w-10 h-10 text-center bg-gray-100" />
                                    <button type="submit" class="ml-3 w-20 h-10 text-white bg-blue-500">Update</button>
                                </form>
                        </td>

                        <td class="px-4 py-3 border">${{ $item->price }}</td>

                        <td class="px-4 py-3 border">
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $item->id }}" name="id">
                                <button class="w-20 h-10 text-white font-bold bg-red-600">X</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                        
                    </tbody>
                </table>
                <div>
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button class="px-6 py-2 my-6 text-red-800 bg-red-300">Clear Cart</button>
                    </form>
                </div>
                <h1 class="pt-4 font-bold"> Total: ${{ Cart::getTotal() }} </h1>
                <div>
                    <form action="{{ route('order.place') }}" method="POST">
                        @csrf
                        <button class="px-6 py-2 my-3 text-white bg-blue-500">Place Order</button>
                    </form>
                </div>
            </div>  
            
        </div>
        
    </div>
@endsection