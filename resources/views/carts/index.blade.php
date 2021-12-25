<div class="col-md-12">
    <h3>Items (1)</h3>
</div>
<hr>
@php
    $subtotal = 0;
@endphp
<div class="col-md-12">
    @foreach ($carts as $cart)
        @php
            $subtotal = $subtotal + ($cart->price * $cart->quantity);
        @endphp
    <div class="row">
        <div class="col-md-6" style="margin-bottom:15px;">
            <h6 style="color:black;">{{ $cart->product_name }}</h6>
        </div>
        <div class="col-md-4">
            <p><span style="color:#666;"><b>RM {{ number_format($cart->price, 2) }}</b></span> x {{ $cart->quantity }}</p>
        </div>
        <div class="col-md-2">
            <a href="javascript:;" onclick="deleteItem({{ $cart->id }})" class="sa-params">
                <button type="button" class="btn ripple btn-danger btn-sm pull-right">X</button>
            </a>
        </div>
    </div>
    @endforeach
</div>
<hr>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <h6>Total : </h6>
        </div>
        <div class="col-md-6">
            <p class="pull-right" style="line-height:3px;">RM {{ number_format($subtotal, 2) }}</p>
        </div>
    </div>
</div>
<hr>
<div class="col-md-12 mt-2">
    <div class="row">
        <button type="button" onclick="deliveryInfo()" class="btn ripple btn-primary btn-block">Checkout</button>
        <button type="button" onclick="removeAllCartItems()" class="btn ripple btn-warning btn-block">Clear</button>
    </div>
</div>