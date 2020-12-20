@extends('layouts.main')

@section('title', 'Products')
  
@section('content')
<div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
  <nav id="store" class="w-full z-30 top-0 px-6 py-1">
      <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
        <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
          Store
        </a>
      </div>
  </nav>
  @forelse($products as $row)

  <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
    
        <img class="hover:grow hover:shadow-lg" src="https://images.unsplash.com/photo-1555982105-d25af4182e4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80">
        <div class="pt-3 flex items-center justify-between">
            <p class="">{{ $row->name }}</p>
            <a href="#">
            <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path d="M21,7H7.462L5.91,3.586C5.748,3.229,5.392,3,5,3H2v2h2.356L9.09,15.414C9.252,15.771,9.608,16,10,16h8 c0.4,0,0.762-0.238,0.919-0.606l3-7c0.133-0.309,0.101-0.663-0.084-0.944C21.649,7.169,21.336,7,21,7z M17.341,14h-6.697L8.371,9 h11.112L17.341,14z" />
              <circle cx="10.5" cy="18.5" r="1.5" />
              <circle cx="17.5" cy="18.5" r="1.5" />
          </svg>
        </a>

        </div>
        <p class="">{{ $row->description }}</p>
        <p class="pt-1 text-gray-900">$ {{ $row->price }}</p>

        <form action="{{ route('addToCart') }}" method="POST">
          @csrf
          <div class="product_count">
            <label for="qty">Quantity:</label>
            <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
            
            <!-- BUAT INPUTAN HIDDEN YANG BERISI ID PRODUK -->
            <input type="hidden" name="product_id" value="{{ $row->id }}" class="form-control">
          </div>
          <div class="card_area">
            
            <!-- UBAH JADI BUTTON -->
            <button class="main_btn">Add to Cart</button>
            <!-- UBAH JADI BUTTON -->
            
          </div>
        </form>
</div>
@empty
                    
@endforelse

</div>
@endsection