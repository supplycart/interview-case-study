@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Home') }}</div>

                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
</div>
                    
                <div class="max-w rounded overflow-hidden shadow-lg">
                        <div class="px-6 py-4 divide-y divide-gray-400">
                            @foreach ($products as $product)
                                <form action="/addToCart" method="POST">
                                    @csrf
                                    <div class="m-10">
                                        <p>Name: </p><p class="font-bold">{{$product->name}}</p>
                                        <p class="pt-6">Description: </p><p class="font-bold">{{$product->description}}</p>
                                        <p class="pt-6">RM </p><p class="font-bold">{{$product->price}}</p>
                                        <input value="{{$product->id}}" name="productId" hidden>
                                        <button class="mt-10 font-bold py-2 px-4 rounded bg-blue-500 text-white">Add to Cart</button>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
