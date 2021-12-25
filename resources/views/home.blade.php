@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-8">
            <div class="row col-md-12">
                <div class="col-md-6 col-lg-6 col-xl-4 col-sm-6">
                    <div class="card custom-card">
                        <div class="p-0 ht-100p">
                            <div class="product-grid">
                                <div class="product-image">
                                    <a href="#" class="image">
                                        <img class="pic-1" alt="product-image-1" src="{{ asset('img/products/red.png') }}">
                                        <img class="pic-2" alt="product-image-2" src="{{ asset('img/products/blue.png') }}">
                                    </a>
                                    <span class="product-discount-label">-10%</span>
                                    <div class="product-link">
                                        <a href="javascript:;" id="add-to-cart1" onclick="storeToCart(1)">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span>Add to cart</span>
                                        </a>
                                        <a href="{{ route('product-detail', 1) }}">
                                            <i class="fas fa-eye"></i>
                                            <span>Product Detail</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="#">Women's Red dress</a></h3>
                                    <span class="text-danger"><b></b></span>
                                    <div class="price"><span class="old-price">RM 250.00</span><span class="text-danger">RM 225.00</span></div>
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label class="required">Quantity</label>
                                                <div class="d-flex justify-content-center">
                                                    <div class="handle-counter" id="handleCounter1">
                                                        <input type="number" name="quantity1" id="quantity1" min="1" value="1" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-4 col-sm-6">
                    <div class="card custom-card">
                        <div class="p-0 ht-100p">
                            <div class="product-grid">
                                <div class="product-image">
                                    <a href="#" class="image">
                                        <img class="pic-1" alt="product-image-1" src="{{ asset('img/products/red.png') }}">
                                        <img class="pic-2" alt="product-image-2" src="{{ asset('img/products/blue.png') }}">
                                    </a>
                                    <span class="product-discount-label">-10%</span>
                                    <div class="product-link">
                                        <a href="#" id="add-to-cart1" onclick="storeToCart(2)">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span>Add to cart</span>
                                        </a>
                                        <a href="{{ route('product-detail', 2) }}">
                                            <i class="fas fa-eye"></i>
                                            <span>Product Detail</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="#">Hawa Luxe Premium</a></h3>
                                    <span class="text-danger"><b></b></span>
                                    <div class="price"><span class="old-price">RM 350.00</span><span class="text-danger">RM 315.00</span></div>
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label class="required">Quantity</label>
                                                <div class="d-flex justify-content-center">
                                                    <div class="handle-counter" id="handleCounter1">
                                                        <input type="number" name="quantity2" id="quantity2" min="1" value="1" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

    function storeToCart(id)
    {
        var url = "{{ route('carts.cart-store') }}";

        var token = "{{ csrf_token() }}";
        var quantity = $('#quantity'+id).val();

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