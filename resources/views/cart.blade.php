@extends('layouts.app')
@section('header')
    <base-header title="Home"></base-header>
@endsection

@section('content')
    <div class="mx-auto w-full py-6">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-400">
                        <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Product
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Qty
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Subtotal
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                         <?php $total = 0 ?>
                            @if(session('cart'))
                            @foreach((array) session('cart') as $id => $details)
                                <?php $total += $details['price'] * $details['quantity'] ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="{{ $details['photo'] }}?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $details['name'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">${{ $details['price'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="number" value="{{ $details['quantity'] }}" class="quantity form-control shadow-sm sm:text-sm rounded-md py-1 border border-gray-400 text-center w-10" />
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                $<span class="product-subtotal">{{ $details['price'] * $details['quantity'] }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center w-20">
                                    <div class="flex-1 w-10 px-1">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900 update-cart" data-id="{{ $id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="flex-1 w-10 px-1">
                                        <a href="#" class="text-red-600 hover:text-red-900 remove-from-cart" data-id="{{ $id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                            @endforeach
                            @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="hidden-xs text-left">
                                <a href="{{route('checkout.index', $total) }}" class="bg-center inline-flex justify-center w-auto rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-600 text-sm font-medium my-1 mx-10 text-white">
                                    Proceed to Checkout
                                </a>
                            </td>
                            <td colspan="2" class="hidden-xs text-left"></td>
                            <td colspan="2" class="hidden-xs text-center p-2">
                                <div class="items-center">
                                    <strong>Total $<span class="cart-total">{{ $total }}</span></strong>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    jQuery(document).ready(function(e){
        $(".update-cart").click(function(e){
            e.preventDefault();

            var self = $(this);
            var parent_row = self.parents("tr");
            var quantity = parent_row.find(".quantity").val();
            var product_subtotal = parent_row.find("span.product-subtotal");
            var cart_total = $(".cart-total");

            $.ajax({
                url: '{{ url('cart/update') }}',
                method: "patch",
                data: {_token: '{{ csrf_token() }}', id: self.attr("data-id"), quantity: quantity},
                dataType: "json",
                success: function (response) {
                    loading.hide();
                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                    $("#header-bar").html(response.data);
                    product_subtotal.text(response.subTotal);
                    cart_total.text(response.total);
                }
            });
        });

        $(".remove-from-cart").click(function(e){
            e.preventDefault();

            var self = $(this);
            var parent_row = self.parents("tr");
            var cart_total = $(".cart-total");

            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('cart/remove') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: self.attr("data-id")},
                    dataType: "json",
                    success: function (response) {
                        parent_row.remove();
                        $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                        $("#header-bar").html(response.data);
                        cart_total.text(response.total);
                    }
                });
            }
        });
    });
</script>
@endpush