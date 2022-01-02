@extends('layouts.app')

@section('content')
<div class="container">
  <div class="">
    Your Total is :  {{ number_format($total, 2, '.', '') }}
  </div>
  <div class="">
    <form class="" action="{{ url('/payment/fail') }}" method="post">
      @csrf
      <button type="submit" name="button">Fail Payment</button>
    </form>
    <form class="" action="{{ url('/payment/success') }}" method="post">
      @csrf
      <button type="submit" name="button">Successful Payment</button>
    </form>
  </div>
</div>
@endsection
