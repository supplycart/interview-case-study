@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-8">
                <div class="card custom-card">
                    <div class="card-body h-100">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="clearfix carousel-slider">
                                            <div id="thumbcarousel" class="carousel slide" data-interval="false">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <div data-target="#carousel" data-slide-to="0" class="thumb my-2">
                                                            <img class="img-md" src="{{ asset('img/products/red.png') }}" style="max-height: 80px" alt="img">
                                                        </div>
                                                        <div data-target="#carousel" data-slide-to="1" class="thumb my-2">
                                                            <img class="img-md" src="{{ asset('img/products/blue.png') }}" style="max-height: 80px" alt="img">
                                                        </div>
                                                        <div data-target="#carousel" data-slide-to="2" class="thumb my-2">
                                                            <img class="img-md" src="{{ asset('img/products/white.png') }}" style="max-height: 80px" alt="img">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-9 col-8">
                                        <div class="product-carousel">
                                            <div id="carousel" class="carousel slide" data-ride="false">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item  active ">
                                                        <img src="{{ asset('img/products/red.png') }}" style="max-height: 500px" alt="img" class="img-fluid mx-auto d-block">
                                                    </div>
                                                    <div class="carousel-item ">
                                                        <img src="{{ asset('img/products/blue.png') }}" style="max-height: 500px" alt="img" class="img-fluid mx-auto d-block">
                                                    </div>
                                                    <div class="carousel-item ">
                                                        <img src="{{ asset('img/products/white.png') }}" style="max-height: 500px" alt="img" class="img-fluid mx-auto d-block">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="mt-4 mb-4">
                                    <h4 class="mt-1 mb-3">{{ $product_name }}</h4>
                                </div>
                                <hr>

                                <div class="d-flex mt-4 mb-4">
                                    <h6 class="fs-14">Stock:</h6>
                                    <div class="row gutters-xs ml-4">
                                        <div class="mr-2">
                                            <b><span class="">50</span></b>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex mt-4 mb-4">
                                    <h6 class="fs-14">Price:</h6>
                                    <div class="row gutters-xs ml-4">
                                        <div class="mr-2">
                                            <b><span class="">RM {{ number_format($price, 2) }}</span></b>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 mb-4">
                                    <h6 class="mt-4 fs-16">Description</h6>
                                    <p>Stock for this product is very limited.</p>
                                    <p>GRAB IT NOW!!</p>
                                </div>
                                <hr>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="required">Quantity</label>
                                            <div class="d-flex">
                                                <div class="handle-counter" id="handleCounter">
                                                    <input type="number" name="quantity" id="quantity" min="1" value="1" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 mb-4 btn-list">
                                    <div class="text-center">
                                        <a href="{{ route('home') }}" class="btn ripple btn-secondary mr-2">Back To List</a>
                                        <button id="add-to-cart" onclick="storeToCart()" class="btn btn-success mr-2">Add To Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4">
                <section class="cart-products">
                    <div class="card custom-card">
                        <div class="card-body" id="cart-product-list">
                            {{-- Load the cart items here --}}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@push('footer-script')
<script>
    cartItemList();

    function cartItemList()
    {
        var url = "{{ route('carts.cart-list-items') }}";
        console.log(url);

        $("#cart-product-list").load(url);
    }

    function storeToCart()
    {
        var url = "{{ route('carts.cart-store') }}";

        var id = {{ $id }};
        var token = "{{ csrf_token() }}";
        var quantity = $('#quantity').val();

        var data = {
            '_token': token,
            'id': id,
            'quantity': quantity,
        };

        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function(response) {
                console.log(response);
                if(response['status'] == 'success'){
                    alert(response['message']);
                    cartItemList();
                }
            }
        });
    }

    function deleteItem(id)
    {
        var url = "{{ route('carts.cart-destroy', ':id') }}";
        url = url.replace(':id', id);
        var token = "{{ csrf_token() }}";

        $.ajax({
            type: 'POST',
            url: url,
            data: {'_token': token, 'method': 'DELETE'},
            success: function(response) {
                console.log(response);
                if(response['status'] == 'success'){
                    alert(response['message']);
                    cartItemList();
                }
            }
        });
    }

    function removeAllCartItems()
    {
        var url = "{{ route('carts.cart-all-destroy') }}";

        var token = "{{ csrf_token() }}";

        $.ajax({
            type: 'POST',
            url: url,
            data: {'_token': token, 'method': 'DELETE'},
            success: function(response) {
                console.log(response);
                if(response['status'] == 'success'){
                    alert(response['message']);
                    cartItemList();
                }
            }
        });
    }

    function deliveryInfo()
    {
        var url = "{{ route('orders.create') }}";

        location.href = url;
    }
</script>
@endpush