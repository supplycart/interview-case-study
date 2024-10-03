@extends('layout.app')

@section('title', 'Login')

@section('pageheadertext', __("Login") )

@section('style')
    @parent
@endsection

@section('script')
    @parent
@endsection

@section('content')

<a href="{{ route('customer_list' )}}">Customer List</a>
<br />
<a href="{{ route('order.list' )}}">Order List</a>
<br />
<a href="{{ route('product.list' )}}">Product List</a>
<br />
<a href="{{ route('transaction.list' )}}">Transaction List</a>
    
@endsection