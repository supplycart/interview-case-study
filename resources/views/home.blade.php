@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row pb-3">
                <div class="form-group col-10">
                    <input type="text" class="form-control input-sm" placeholder="Search" autocomplete="search">
                </div>

                <div class="form-group col-2">
                    <select class="form-select">
                        <option selected>Category</option>
                        <option value="1">Food</option>
                        <option value="2">Drink</option>
                    </select>
                </div>
            </div>

            @foreach ($items as $item)
            <div class="card mb-3">
                <div class="row card-body">
                    <img src="/storage/{{ $item["image"] }}" class="w-50">
                    <div class="w-50">
                        <p class="h4 fw-bold">{{ $item["name"] }}</p>
                        <p class="">{{ $item["desc"] }}</p>
                        <p class="h5 fw-bold position-absolute bottom-0 mb-3">${{ number_format($item["price"], 2, ".", "") }}</p>
                        <button class="btn btn-success position-absolute bottom-0 end-0 mb-3 me-3 text-white">Add to Cart</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
