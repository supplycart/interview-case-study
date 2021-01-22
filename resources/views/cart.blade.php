@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cart</div>
                    <div class="card-body">
                        <table id="cart" class="table table-hover table-condensed">
                            <thead>
                            <tr>
                                <th style="width:50%">Product</th>
                                <th style="width:10%">Price</th>
                                <th style="width:8%">Quantity</th>
                                <th style="width:22%" class="text-center">Subtotal</th>
                                <th style="width:10%"></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $total = 0 ?>

                            @if(session('cart'))
                                @foreach(session('cart') as $id => $details)

                                    <?php $total += $details['price'] * $details['quantity'] ?>

                                    <tr>
                                        <td data-th="Product">
                                            <div class="row">
                                                <div class="col-sm-3 hidden-xs"><img src="{{ $details['photo'] }}"
                                                                                     width="100"
                                                                                     height="100"
                                                                                     class="img-responsive"/></div>
                                                <div class="col-sm-9">
                                                    <h4 class="nomargin">{{ $details['name'] }}</h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-th="Price">MYR{{ $details['price'] }}</td>
                                        <td data-th="Quantity">
                                            <input type="number" value="{{ $details['quantity'] }}"
                                                   class="form-control quantity"/>
                                        </td>
                                        <td data-th="Subtotal" class="text-center">
                                            MYR{{ $details['price'] * $details['quantity'] }}</td>
                                        <td class="actions" data-th="">
                                            <button class="btn btn-info btn-sm update-cart" data-url="{{ url('update-cart') }}" data-id="{{ $id }}"><i
                                                    class="fa fa-refresh"></i></button>
                                            <button class="btn btn-danger btn-sm remove-from-cart" data-url="{{ url('remove-from-cart') }}" data-id="{{ $id }}">
                                                <i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td>No Product Yet</td>
                            </tr>
                            @endif

                            </tbody>
                            <tfoot>
                            <tr>
                                <td><a href="{{ url('/product') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i>
                                        Continue Shopping</a></td>
                                <td colspan="2" class="hidden-xs"></td>
                                <td class="hidden-xs text-center"><strong>Total: MYR{{ $total }}</strong></td>
                                <td><button class="btn btn-success place-order" data-url="{{ url('/order') }}" data-total="{{ $total }}">Place Order</button></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {

            $(".update-cart").click(function (e) {
                e.preventDefault();
                let ele = $(this);

                $.ajax({
                    url: ele.attr('data-url'),
                    method: "patch",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.attr("data-id"),
                        quantity: ele.parents("tr").find(".quantity").val()
                    },
                    success: function (response) {
                        alert(response.message)
                        window.location.reload();
                    }
                });
            });

            $(".remove-from-cart").click(function (e) {
                e.preventDefault();

                let ele = $(this);

                if (confirm("Are you sure")) {
                    $.ajax({
                        url: ele.attr('data-url'),
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: ele.attr("data-id")},
                        success: function (response) {
                            alert(response.message)
                            window.location.reload();
                        }
                    });
                }
            });

            $(".place-order").click(function (e) {
                e.preventDefault();

                let ele = $(this);

                $.ajax({
                    url: ele.attr('data-url'),
                    method: "post",
                    data: {
                        _token: '{{ csrf_token() }}',
                        total: ele.attr("data-total")
                    },
                    success: function (response) {
                        alert(response.message)
                        window.location.reload();
                    }
                });

            });

        });

    </script>
@endsection


