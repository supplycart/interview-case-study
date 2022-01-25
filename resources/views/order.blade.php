@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Order History') }}</div>

                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
</div>
                <div class="max-w rounded overflow-hidden shadow-lg">
                    <div class="px-6 py-4 divide-y divide-gray-400">
                        @foreach ($orders as $order)
                            <div class="m-10">
                                <p>Name: </p><p class="font-bold">{{$order->order_uuid}}</p>
                                <p>Place At: </p><p class="font-bold">{{$order->created_at}}</p>
                                @foreach($order->products as $index => $orderProduct)
                                <p>{{$index+1}}. Product Name: </p><p class="font-bold">{{$orderProduct->name}}</p>
                                @endforeach
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
