@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Product</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-12 main-section">
                                    <div class="dropdown-cart">
                                        <button type="button" class="btn btn-info" data-toggle="dropdown">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span
                                                class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                        </button>
                                        <div class="dropdown-menu cart-view">
                                            <div class="row total-header-section">
                                                <div class="col-lg-6 col-sm-6 col-6">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span
                                                        class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                                </div>
                                                <?php $total = 0 ?>
                                                @foreach((array) session('cart') as $id => $details)
                                                    <?php $total += $details['price'] * $details['quantity'] ?>
                                                @endforeach
                                                <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                                    <p>Total: <span class="text-info">RM {{ $total }}</span></p>
                                                </div>
                                            </div>
                                            @if(session('cart'))
                                                @foreach(session('cart') as $id => $details)
                                                    <div class="row cart-detail">
                                                        <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                                            <img src="{{ $details['photo'] }}"/>
                                                        </div>
                                                        <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                            <p>{{ $details['name'] }}</p>
                                                            <span
                                                                class="price text-info"> RM{{ $details['price'] }}</span>
                                                            <span
                                                                class="count"> Quantity:{{ $details['quantity'] }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="row">
                                                <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                                    <a href="{{ url('cart') }}" class="btn btn-primary btn-block">View
                                                        all</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="container-inner" class="container page">

                            <div class="row">

                                @foreach($products as $product)
                                    <div class="col-xs-18 col-sm-6 col-md-3">
                                        <div class="thumbnail">
                                            <img src="{{ $product->photo }}" width="500" height="300">
                                            <div class="caption">
                                                <h4>{{ $product->name }}</h4>
                                                <p>{{ str_limit($product->description, 100) }}</p>
                                                <p><strong>Price: </strong> MYR{{ $product->price }}</p>
                                                <button id="add-to-cart" class="btn btn-primary btn-block add-cart"
                                                        data-product-id="{{ $product->id }}"
                                                        data-url="{{ url('add-to-cart') }}"
                                                        title="Add to cart">Add To Cart</button>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div><!-- End row -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {

            $('.add-cart').click(function (){
                let url = $(this).attr('data-url');
                $.get(url + '/' + $(this).attr('data-product-id'), function (response) {
                    if (response.status) {
                        alert(response.message)
                       window.location.reload();
                    } else {
                        alert(response.message);
                    }
                });
            });

        });
    </script>
@endsection
