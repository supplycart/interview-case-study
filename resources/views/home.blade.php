@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-8">
            <div class="row col-md-12 mb-2">
                {!! Form::open(['route' => ['home-category'], 'id'=>'category-form','class'=>'ajax-form','method'=>'POST']) !!}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="category">Filter Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">Select One</option>
                            <option value="A">Category A</option>
                            <option value="B">Category B</option>
                        </select>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

            @php
                $priceAfterDiscount = 0;
            @endphp
            <div class="row col-md-12">
                @foreach ($products ?: [] as $product)
                    @php
                        $priceAfterDiscount = $product->price - (($product->discount / 100) * $product->price)
                    @endphp
                    <div class="col-md-6 col-lg-6 col-xl-4 col-sm-6">
                        <div class="card custom-card">
                            <div class="p-0 ht-100p">
                                <div class="product-grid">
                                    <div class="product-image">
                                        <a href="#" class="image">
                                            <img class="pic-1" alt="product-image-1" src="{{ asset($product->picture_a) }}">
                                            <img class="pic-2" alt="product-image-2" src="{{ asset($product->picture_b) }}">
                                        </a>
                                        <span class="product-discount-label">-{{ $product->discount }}%</span>
                                        <div class="product-link">
                                            <a href="javascript:;" id="add-to-cart{{$product->id}}" onclick="storeToCart({{ $product->id }})">
                                                <i class="fa fa-shopping-cart"></i>
                                                <span>Add to cart</span>
                                            </a>
                                            <a href="{{ route('product-detail', $product->id) }}">
                                                <i class="fas fa-eye"></i>
                                                <span>Product Detail</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a href="#">{{ $product->product_name }}</a></h3>
                                        <span class="text-danger"><b></b></span>
                                        <div class="price"><span class="old-price">RM {{ number_format($product->price, 2) }}</span><span class="text-danger">RM {{ number_format($priceAfterDiscount, 2) }}</span></div>
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label class="required">Quantity</label>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="handle-counter" id="handleCounter1">
                                                            <input type="number" name="quantity{{$product->id}}" id="quantity{{$product->id}}" min="1" value="1" class="form-control">
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
                @endforeach
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

    $('#category').on('change', function(){
        $('#category-form').submit();
    });

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