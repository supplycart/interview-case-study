@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> -->

    <!-- filter -->
    <div class="">
      <form class="" action="{{ url('/home/search') }}" method="post">
        @csrf
        <div class="">
          <label for="">Category</label>
          <input type="text" name="category" value="">

          <label for="">Brand</label>
          <input type="text" name="brand" value="">

          <label for="">Name</label>
          <input type="text" name="name" value="">

          <button type="submit" name="button">Search</button>
        </div>
      </form>
    </div>

    <!-- checkout -->
    <div class="">
      My Cart
      <form class="" action="{{ url('/checkout') }}" method="post">
        @csrf
        <div class="text-right">
          <button class="" type="submit" name="button">
            Checkout
          </button>
        </div>

        <div class="">
          <strong class="text-uppercase">
            Item list:
          </strong>
          <table class="table table-bordered">
            <tr>
              <th>
                #
              </th>
              <th>
                Item
              </th>
              <th style="width: 20px;">
                Quantity
              </th>
              <th style="width: 20px;">
                Price
              </th>
              <!-- <th style="width: 20px;">
                Select
              </th> -->
            </tr>
            @foreach (Auth::User()->cart()->whereNull('purchased_at')->get() as $key => $value)
            <tr>
              <td>
                {{ $key+1 }}
              </td>
              <td>
                {!! $value->category."<br>".$value->brand."<br>".$value->name !!}
              </td>
              <td>
                {{ $value->pivot->quantity }}
              </td>
              <td>
                {{ $value->pivot->quantity*$value->price }}
              </td>
              <!-- <th>
                <input type="checkbox" name="items[]" value="{{ $value->pivot->id }}">
              </th> -->
            </tr>
            @endforeach
          </table>
        </div>
      </form>
    </div>

    <!-- product -->
    <div class="d-lg-flex flex-wrap">
      @foreach ($products as $key => $value)
      <div class="col-lg-4 p-3">
          <div class="rounded border" style="min-height: 250px;">
            <div class="text-right m-3">
              <strong style="font-size: 23px;">
                $ {{ $value->price }}
              </strong>
            </div>
            <div class="">
              <img class="w-100" src="https://via.placeholder.com/150" alt="">
            </div>
            <div class="" style="min-height: 25px;">
              <u>
                {{ $value->category }}
              </u>
            </div>
            <div class="" style="min-height: 25px;">
              <i>
                {{ $value->brand }}
              </i>
            </div>
            <div class="" style="min-height: 25px;">
              <strong>
                {{ $value->name }}
              </strong>
            </div>
            <form class="" action="{{ url('addtocart/'.$value->id) }}" method="post">
              @csrf
              <div class="d-flex">
                <input type="number" class="w-100" name="quantity" value="" min="0">
                <button type="submit" name="button">
                  <i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i>
                </button>
              </div>
            </form>
          </div>
        <!-- <a href="#" class="">
          <div class="rounded border" style="min-height: 250px;">
            <div class="">
              <img class="w-100" src="https://via.placeholder.com/150" alt="">
            </div>
            <div class="">
              {{ $value->category }}
            </div>
            <div class="">
              {{ $value->brand }}
            </div>
            <div class="">
              {{ $value->name }}
            </div>
          </div>
        </a> -->
      </div>
      @endforeach
    </div>
</div>
@endsection
