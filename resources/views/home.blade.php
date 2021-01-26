@extends('layouts.app')
@section('header')
    <base-header title="Home"></base-header>
@endsection

@section('content')
    @include('includes/header_cart')
    <div class="container mx-auto py-2 px-2 sm:px-6 lg:px-8"><span id="status"></span></div>
    <div class="mx-auto w-full">
        <div>
            <!-- Card stats -->
            <div class="flex flex-wrap -mx-4">
                 @foreach($products as $product)
                <div class="w-full md:w-1/4 px-3 my-3">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative pr-4 flex-grow flex-1 flex-shrink-1 w-80 h-80">
                                    <h5 class="text-gray-500 uppercase font-bold text-xs">
                                        {{ $product->name }}
                                    </h5>
                                    <img class="object-cover w-full h-full" src="{{ $product->photo}}" alt=""/>
                                </div>
                                <div class="relative w-auto px-2 flex-initial">
                                    <a href="javascript:void(0);" data-id="{{ $product->id }}" class="add-to-cart btn btn-warning btn-block text-center" role="button">
                                        <div class="text-sm text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500">
                                            add
                                        </div>
                                    </a>
                                    <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-4">
                            <span class="whitespace-no-wrap">Price : </span>
                                <span class="text-red-500 mr-2">${{ $product->price}}</span>
                            </p>
                            <p class="text-gray-500 text-sm">{{ $product->description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
    jQuery(document).ready(function(e){
        $(".add-to-cart").click(function(e){
            e.preventDefault();
            var self = $(this);
            self.siblings('.btn-loading').show();

            $.ajax({
                url: '{{ url('cart/add') }}' + '/' + self.attr("data-id"),
                method: "get",
                data: {_token: '{{ csrf_token() }}'},
                dataType: "json",
                success: function (response) {
                    self.siblings('.btn-loading').hide();
                    $("span#status").html('<div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">'+
                            '<div class="flex">'+
                                '<div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>'+
                                '<div>'+
                                    '<p class="font-bold">'+response.msg+'</p>'+
                                '</div>'+
                            '</div>'+
                        '</div>');
                    $("#header-bar").replaceWith(response.data);
                }
            });
        });
    });
    </script>
@endpush