@extends('layouts.app')
@section('content')
<div class="relative mt-6 max-w-lg mx-auto">
<span class="absolute inset-y-0 left-0 pl-3 flex items-center">
    <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
        <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</span>
    <input class="w-full border rounded-md pl-10 pr-4 py-2 focus:border-blue-500 focus:outline-none focus:shadow-outline" id="product_search" type="search" onchange="handleSearch()" onload="setSearch()" placeholder="Search">
</div>
<div class="bg-white">
    <div class="container mx-auto px-6">
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
            @foreach ( $products as $product )
            <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url({{ $product->picture }})">
                    @if ($product->quantity > 0)
                    <form method="POST" action="{{ route('add-product-to-cart', ['product' => $product->id]) }}">
                        @csrf
                        <button class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </button>
                    </form>
                    @endif
                </div>
                <div class="px-5 py-3">
                    <a href={{ route('product-detail', ['product' => $product->id])}}>
                        <h3 class="text-gray-700 uppercase">{{ $product->name }}</h3>
                        <span class="text-gray-500 mt-2">${{ round($product->price,2) }}</span>
                        <div class="grid grid-cols-3 gap-1 text-sm items-center">
                            @foreach ($product->categories as $category)
                            <div class="bg-gray-500 text-green-100 px-3 py-2 rounded">{{ $category->name }}</div>
                            @endforeach
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <br>
        {{ $products->links() }}
    </div>
</div>
<script type = "text/javascript">
    window.onload = function() {
        setSearch();
    }
    function setSearch() {
        const urlParams = new URLSearchParams(window.location.search);
        const myParam = urlParams.get('q');
        document.getElementById('product_search').value = myParam;
    }
    function handleSearch() {
        window.location.assign(`app?q=${document.getElementById('product_search').value}`)
    }
</script>
@endsection