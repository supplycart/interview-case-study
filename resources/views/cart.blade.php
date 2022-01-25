@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cart') }}</div>

                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
</div>
                    
                <div class="max-w rounded overflow-hidden shadow-lg">
                    <div class="px-6 py-4 divide-y divide-gray-400">
                                @if (count($cart_items) == 0)
                                    
                                <p>No items in cart, please add more item </p>
                                @else
                                <form action="/placeOrder" method="POST">
                        <button class="mt-10 font-bold py-2 px-4 rounded bg-blue-500 text-white">Place Order</button>
                                    @csrf
                        @foreach ($cart_items as $item)
                            <div class="m-10">
                                <p>Name: </p><p class="font-bold">{{$item->product->name}}</p>
                                <p class="pt-6">Description: </p><p class="font-bold">{{$item->product->description}}</p>
                                <p class="pt-6">RM </p><p class="font-bold">{{$item->product->price}}</p>
                                <p class="pt-6">Quantity </p><p class="font-bold">x {{$item->quantity}}</p>
                                <p class="pt-6">Amount </p><p class="font-bold">
                                    @php
                                        $totalAmount = $item->quantity * $item->product->price;
                                        echo $totalAmount;
                                    @endphp
                                </p>
                            </div>
                        @endforeach
</form>
                                @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
