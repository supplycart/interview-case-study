@extends('shop.layout')
@section('title', 'Products')
@section('content')
<body class="antialiased">
    <div class="relative flex-1 items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="grid grid-cols-3 gap-4">
            @foreach($products as $product)
                <div>
                    <div class="thumbnail">
                        <img class="object-scale-down h-48 w-48" src="{{ $product->photo }}" alt="">
                        <div class="caption">
                            <h4>{{ $product->name }}</h4>
                            <p>{{ Str::limit(strtolower($product->description), 50) }}</p>
                            <p><strong>Price: </strong> {{ $product->price }}$</p>
                            <p class="btn-holder"><a href="{{ url('add-to-cart/'.$product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div><!-- End row -->
    </div>
</body>
@endsection