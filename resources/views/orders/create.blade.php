@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::open(['route' => ['orders.store'], 'id'=>'payment-order-form','class'=>'ajax-form','method'=>'POST']) !!}
                <div class="row row-sm">
                    <div class="col-lg-12 col-xl-9 col-md-12">
                        <div class="card custom-card">
                            <div class="card-header">
                                <h5 class="mb-3 font-weight-bold tx-14">Address</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required">{{ __('Name') }} <span class="tx-danger">*</span></label>
                                                {!! Form::text('name', null,['placeholder' => '','class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required">{{ __('Email') }} <span class="tx-danger">*</span></label>
                                                {!! Form::text('email', null,['placeholder' => '','class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required">{{ __('Phone No') }} <span class="tx-danger">*</span></label>
                                                {!! Form::text('phone_no', null,['placeholder' => '','class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required">{{ __('Address') }} <span class="tx-danger">*</span></label>
                                                {!! Form::textarea('address', null,['rows' => 5, 'placeholder' => '','class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required">{{ __('Postcode') }} <span class="tx-danger">*</span></label>
                                                {!! Form::text('postcode', null,['placeholder' => '','class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required">{{ __('City') }} <span class="tx-danger">*</span></label>
                                                {!! Form::text('city', null, ['placeholder' => '','class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required">{{ __('State') }} <span class="tx-danger">*</span></label>
                                                {!! Form::text('state', null, ['placeholder' => '','class' => 'form-control select2']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card custom-card">
                            <div class="card-header">
                                <h5 class="mb-3 font-weight-bold tx-14">Your Products</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table border table-hover text-nowrap table-shopping-cart mb-0">
                                        <thead class="text-muted">
                                            <tr class="small text-uppercase">
                                                <th scope="col">Product</th>
                                                <th scope="col">Stock</th>
                                                <th scope="col" class="wd-120">Quantity</th>
                                                <th scope="col" class="wd-120">Price</th>
                                                <th scope="col" class="wd-120">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $subtotal = 0;
                                            @endphp
                                            @foreach ($carts as $cart)
                                                @php
                                                    $subtotal = $subtotal + ($cart->price * $cart->quantity);
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="media">
                                                            <div class="card-aside-img">
                                                                <img src="{{ asset('img/products/red.png') }}" alt="img" class="img-sm">
                                                            </div>
                                                            <div class="media-body my-auto">
                                                                <div class="card-item-desc mt-0">
                                                                    <h6 class="font-weight-semibold mt-0 text-uppercase">{{ $cart->product_name }}</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-danger small mb-0 mt-1 tx-12">50</p>
                                                    </td>
                                                    <td>
                                                        <p class="small mb-0 mt-1 tx-12">{{ $cart->quantity }}</p>
                                                    </td>
                                                    <td>
                                                        <div class="price-wrap"><span class="price tx-12">RM {{ number_format($cart->price, 2) }}</span></div>
                                                    </td>
                                                    <td>
                                                        <div class="price-wrap"><span class="price font-weight-bold tx-16">RM {{ number_format(($cart->price * $cart->quantity), 2) }}</span></div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-xl-3 col-md-12">
                        <div class="card custom-card cart-details">
                            <div class="card-body">
                                <h5 class="mb-3 font-weight-bold tx-14">PRICE DETAIL</h5>
                                <hr>
                                <dl class="dlist-align">
                                    <dt>Total:</dt>
                                    <dd class="text-right  ml-auto"><strong>RM {{ number_format($subtotal, 2) }}</strong></dd>
                                </dl>
                                <button type="submit" class="step-btn btn btn-success btn-block">Proceed</button>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
