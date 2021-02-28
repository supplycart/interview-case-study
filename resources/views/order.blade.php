@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="app">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="py-3">
                        <p class="h5 fw-bold">
                            ID: {{ $orders[0]->id }}
                        </p>
                        <p class="h5 fw-bold">
                            Time: {{ $orders[0]->created_at }}
                        </p>
                        <p class="h5 fw-bold">
                            Status: {{ $orders[0]->status == 0 ? 'Processing' : ($orders[0]->status == 1 ? 'Shipped' : 'Delivered') }}
                        </p>
                    </div>
                    @foreach($items as $item)
                        <div class="card mb-3">
                            <div class="row card-body">
                                <img src="/storage/{{ $item->image }}" class="w-50" alt="item image">
                                <div class="w-50">
                                    <p class="h4 fw-bold">{{ $item->name }} ({{ $item->quantity }})</p>
                                    <p>{{ $item->desc }}</p>
                                    <div class="position-absolute bottom-0 mb-3">
                                        <p class="h5 fw-bold">
                                            Retail: ${{ number_format($item->price, 2) }}
                                        </p>
                                        <p class="h5 fw-bold">
                                            Subtotal: ${{ number_format($item->price * $item->quantity, 2) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="pt-3">
                        <p class="h5 fw-bold text-end">
                            Total: ${{ number_format($total, 2)  }}
                        </p>
                    </div>
                    <div class="d-flex justify-content-center pt-4">
                        {{ $orders->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
