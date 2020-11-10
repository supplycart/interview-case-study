@extends('layouts.app')

@section('content')
    <h3 class="text-center">All Products</h3><br />
    <div class="flex justify-center h-screen">
        <div class="grid grid-cols-3 gap-4">
            @foreach ($products as $product)
                <div>
                    <button type="submit"
                        class="w-full max-w-sm mx-auto rounded-md shadow-lg overflow-hidden text-left add-to-cart "
                        data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-id="{{ $product->id }}">
                        <div class="flex items-end justify-end h-56 w-full bg-cover"
                            style="background-image: url('https://images.unsplash.com/photo-1495856458515-0637185db551?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80')">
                        </div>
                        <div class="px-5 py-3 space-y-3">
                            <h3 class="text-gray-700 uppercase font-semibold">{{ $product->name }}</h3>
                            <p class="text-blue-500 text-sm font-semibold">{{ $product->brand }}</p>
                            <p class="text-blue-700 text-sm font-semibold">{{ $product->category }}</p>
                            <p class="text-gray-500 text-sm">{{ $product->descriptions }}</p>
                            <p class="font-bold mt-2line-through">
                                @if ($product->special_prices->first() !== null)
                                    <span class="line-through text-red-500"> RM {{ $product->price }} </span>
                                @endif
                                <span class="text-orange-500"> RM
                                    {{ $product->special_prices->first()->price ?? $product->price }}</span>
                            </p>
                        </div>
                    </button>
                </div>
            @endforeach
        </div>
    </div>
@endsection
