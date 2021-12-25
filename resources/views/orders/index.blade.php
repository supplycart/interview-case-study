@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 20px">No</th>
                                    <th>Order Date</th>
                                    <th>Products</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ date('d M Y', strtotime($order->created_at)) }}</td>
                                        <td>
                                            <ul>
                                            @foreach ($order->orderItem as $item)
                                                <li>
                                                    Product Name: {{ $item->product_name }} <br/>
                                                    Quantity: {{ $item->quantity }} <br/>
                                                    Price: {{ $item->price }}
                                                </li>
                                            @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="card-footer clearfix">
                            {{ $orders->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection