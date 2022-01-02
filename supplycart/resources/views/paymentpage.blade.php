@extends('layouts.app')

@section('content')
<div class="container">
  <div class="">
    Your Total is :  {{ number_format($total, 2, '.', '') }}
  </div>
  <div class="flex">
    <form class="my-4 mx-4" action="{{ url('/payment/fail') }}" method="post">
      @csrf
      <button class="bg-red-700 hover:bg-red-500 rounded p-2" type="submit" name="button">Fail Payment</button>
    </form>
    <form class="my-4 mx-4" action="{{ url('/payment/success') }}" method="post">
      @csrf
      <button class="bg-green-700 hover:bg-green-500 rounded p-2" type="submit" name="button">Successful Payment</button>
    </form>
  </div>
</div>
@endsection
