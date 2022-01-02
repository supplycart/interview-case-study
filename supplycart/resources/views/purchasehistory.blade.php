@extends('layouts.app')

@section('content')
<div class="container">
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
      <th style="width: 120px;">
        Purchased At
      </th>
    </tr>
    @foreach (Auth::User()->cart()->whereNotNull('purchased_at')->get() as $key => $value)
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
      <td>
        {{ Carbon\Carbon::parse($value->pivot->purchased_at)->format('d/m/Y') }}
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endsection
