@extends('layouts.app')
@section('content')
<div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
    <div class="align-middle rounded-tl-lg rounded-tr-lg inline-block w-full py-4 overflow-hidden bg-white shadow-lg px-12">
        <div class="flex justify-between">
            <div class="inline-flex border rounded w-7/12 px-2 lg:px-6 h-12 bg-transparent">
                <div class="flex flex-wrap items-stretch w-full h-full mb-6 relative">
                    <div class="flex">
                        <span class="flex items-center leading-normal bg-transparent rounded rounded-r-none border border-r-0 border-none lg:px-3 py-2 whitespace-no-wrap text-grey-dark text-sm">
                            <svg width="18" height="18" class="w-4 lg:w-auto" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.11086 15.2217C12.0381 15.2217 15.2217 12.0381 15.2217 8.11086C15.2217 4.18364 12.0381 1 8.11086 1C4.18364 1 1 4.18364 1 8.11086C1 12.0381 4.18364 15.2217 8.11086 15.2217Z" stroke="#455A64" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16.9993 16.9993L13.1328 13.1328" stroke="#455A64" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                    <input type="text" class="flex-shrink flex-grow flex-auto leading-normal tracking-wide w-px flex-1 border border-none border-l-0 rounded rounded-l-none px-3 relative focus:outline-none text-xxs lg:text-xs lg:text-base text-gray-500 font-thin" placeholder="Search">
                </div>
            </div>
        </div>
    </div>
    <div class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
    <table id="ordered" class="ui celled table all_orders" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Order ID</th>
                <th>User Id</th>
                <th>Order Time</th>
                <th>Total Order</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    </div>
</div>
<div>
    <div class="modal fade" id="getDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Order <span class="unique-order"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <table class="show-cart table">

            </table>
            <div>Total price: $<span class="total-cart"></span></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{-- <button id="place_order" type="button" class="btn btn-primary">Place Order</button> --}}
            </div>
        </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')

<script type="text/javascript">

    var table_order;
    var curr_row;
    var token = "{{ csrf_token() }}";

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){

        console.log('doc ready! ');

        //render the datatable item
        table_order = $('#ordered').DataTable({

            "pageLength": 50,
            "searching": false,
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": "{{ url('/populate/order') }}" ,
                "type": "GET",
            },
            "columns": [
                { "data": "DT_RowIndex", "name": "DT_RowIndex", orderable: false, searchable: false },
                { "data": "order_id", "name": "order_id" },
                { "data": "user_id", "name": "user_id" },
                { "data": "created_at", "name": "created_at" },
                { "data": "total_order", "name": "total_order"},
                { "data": "status", "name": "status" },
                { "data": "action", "name": "action", orderable: false, searchable: false },
            ],
            "columnDefs": [
                {
                    //add button view
                    "targets": 6,
                    "defaultContent": '<button class="edit btn btn-success btn-sm">View Details</button>'
                }

            ]
        });

        //if button view clicked, show order details
        $('table').on('click', '.edit', function(){

            var details = table_order.row($(this).closest('tr')).data();

            console.log(JSON.stringify(details.order_id));
            details = JSON.stringify(details.order_id);

            $.ajax({
                type: "POST",
                url: "{{ url('/get/order-details') }}",
                data: { token: token, id: details },
                success:function(data){

                    console.log('return success : ' + JSON.stringify(data.message));
                    var product = JSON.stringify(data.message);
                    var output = "";
                    var total_price = 0;

                    output = '<tr><td>Image</td><td>Name</td><td>Quantity</td><td>Price</td><td>Total Price</td></tr>';

                    for(var i in data.message) {
                        let pic = data.message[i].item_picture;

                        output += '<tr>'
                        + '<td><img src="' + pic + '" style="width:50px;height:50px;"></td>'
                        + "<td>" + data.message[i].item_name + "</td>"
                        + "<td>" + data.message[i].item_quantity + "</td>"
                        + "<td>$(" + data.message[i].item_price + ")</td>"
                        + " = "
                        + "<td>$" + data.message[i].total_price + "</td>"
                        +  "</tr>";

                        total_price += data.message[i].total_price;
                    }

                    $('.show-cart').html(output);
                    $('.unique-order').html(data.message[0].order_id);
                    $('.total-cart').html(total_price);
                    $('#getDetails').modal('show');

                },
                error:function(){

                    console.log('return fail');

                }
            });

        });

    });







</script>
@endpush
