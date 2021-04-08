@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                    @foreach ($allproduct as $item)
                      <div class="col-sm-6">
                        <div class="card">
                          <div class="card-body">
                            <img src=" {{asset('productphoto')."/".$item->photo}}" alt="" class="img-thumbnail">
                            <h5 class="card-title">{{$item->name}}</h5>
                            <h6 class="card-text">{{$item->brand}}</h6>
                            <p class="card-text">{{$item->price}}</p>
                            <p class="card-text">{{$item->category}}</p>
                            <a href="#" class="btn btn-primary">Add to cart</a>
                          </div>
                        </div>
                      </div>
        
                    @endforeach  
                        
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

