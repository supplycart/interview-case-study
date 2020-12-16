@extends('layouts.app')

@section('content')
    <h1>This is products page</h1>
    @if(count($products) > 0)
        @foreach($products as $product) 
            <div>
                <h3>{{ $product->name }}</h3>
            </div>
        @endforeach
    @else 
        <p>No products found</p>
    @endif
@endsection