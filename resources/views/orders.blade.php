@extends('layouts.app')

@section('title', 'Order')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">My Order(s)</div>
                    <div class="card-body">
                        @foreach($orders as $order)
                        <h4>Order ID: {{ $order->id }}</h4>
                        <table id="cart" class="table table-hover table-condensed">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th class="sm text-center">Quantity</th>
                                <th class="sm text-center">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->order_items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->product->price }}</td>
                                <td class="sm text-center">{{ $item->quantity }}</td>
                                <td class="sm text-center">{{ $item->quantity * $item->product->price }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3" class="hidden-xs"></td>
                                <td class="hidden-xs text-center"><strong>Total: MYR{{ $order->total }}</strong></td>
                            </tr>
                            </tfoot>
                        </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
