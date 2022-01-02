@extends('layouts.app')

@section('content')
<div class="container">
    <!-- filter -->
    <div class="">
      <form class="" action="{{ url('/home/search') }}" method="post">
        @csrf
        <div class="mx-auto">

          <label class="px-3" for="">Category</label>
          <select class="border-2 border-gray-600" name="category">
            <option value="null" selected disabled>--Please Select--</option>
            @foreach (App\Product::categories() as $key => $value)
            <option value="{{ $value[0]->category }}">{{ $value[0]->category }}</option>
            @endforeach
          </select>


          <label class="px-3" for="">Brand</label>
          <select class="border-2 border-gray-600" name="brand">
            <option value="null" selected disabled>--Please Select--</option>
            @foreach (App\Product::brands() as $key => $value)
            <option value="{{ $value[0]->brand }}">{{ $value[0]->brand }}</option>
            @endforeach
          </select>


          <label class="px-3" for="">Name</label>
          @if (isset($_GET['name']))
          <input class="border-2 border-gray-600" type="text" name="name" value="{{ $_GET['name'] }}">
          @else
          <input class="border-2 border-gray-600" type="text" name="name" value="">
          @endif

          <button class="bg-blue-200 hover:bg-blue-700 rounded py-2 px-4 text-gray-500 mx-3" type="submit" name="button">Search</button>
        </div>
      </form>
    </div>

    <!-- checkout -->
    <div class="">
      My Cart
      <form class="" action="{{ url('/checkout') }}" method="post">
        @csrf
        <div class="text-right">
          <button class="bg-yellow-300 hover:bg-yellow-500 rounded px-3 py-1" type="submit" name="button">
            <strong>
              Checkout
            </strong>
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
                $ {{ Auth::User()->priceByRole($value->price) }}
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
