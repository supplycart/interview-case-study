@extends('layouts.app')
@section('content')

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://tailwindcomponents.com/css/component.ecommerce-products-list.css" rel="stylesheet">
    </head>
    <style type="text/css">
        .show-cart li {
            display: flex;
        }
    </style>
    <body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <div x-data="{ cartOpen: false , isOpen: false }" class="bg-white">
        <header>
            <div class="container mx-auto px-6 py-3">
                <div class="flex items-center justify-between">
                    <div class="hidden w-full text-gray-600 md:flex md:items-center">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.06298 10.063 6.27212 12.2721 6.27212C14.4813 6.27212 16.2721 8.06298 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16755 11.1676 8.27212 12.2721 8.27212C13.3767 8.27212 14.2721 9.16755 14.2721 10.2721Z" fill="currentColor" /><path fill-rule="evenodd" clip-rule="evenodd" d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.39409 5.48178 3.79417C8.90918 0.194243 14.6059 0.054383 18.2059 3.48178C21.8058 6.90918 21.9457 12.6059 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.97318 6.93028 5.17324C9.59603 2.3733 14.0268 2.26452 16.8268 4.93028C19.6267 7.59603 19.7355 12.0268 17.0698 14.8268Z" fill="currentColor" />
                        </svg>
                        <span class="mx-1 text-sm">MY</span>
                    </div>
                    <div class="w-full text-gray-700 md:text-center text-2xl font-semibold">
                        Brand
                    </div>
                    <div class="flex items-center justify-end w-full">
                        <button data-toggle="modal" data-target="#cart" class="text-gray-600 focus:outline-none mx-4 sm:mx-0">
                            (<span class="total-count"></span>)
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </button>

                        {{-- <div class="flex sm:hidden">
                            <button @click="isOpen = !isOpen" type="button" class="text-gray-600 hover:text-gray-500 focus:outline-none focus:text-gray-500" aria-label="toggle menu">
                                <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current">
                                    <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                                </svg>
                            </button>
                        </div> --}}
                    </div>
                </div>
                <nav :class="isOpen ? '' : 'hidden'" class="sm:flex sm:justify-center sm:items-center mt-4">
                    <div class="flex flex-col sm:flex-row">
                        <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Home</a>
                        <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Shop</a>
                        <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Categories</a>
                        <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Contact</a>
                        <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">About</a>
                    </div>
                </nav>
                <div class="relative mt-6 max-w-lg mx-auto">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                        <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                    <input class="w-full border rounded-md pl-10 pr-4 py-2 focus:border-blue-500 focus:outline-none focus:shadow-outline" type="text" placeholder="Search">
                </div>
            </div>
        </header>

        {{-- <nav class="">
            <div class="">
                <div class="">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cart">Cart (<span class="total-count"></span>)</button>
            </div>
        </nav> --}}

        <!-- Modal -->
        <div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
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
                    <button id="place_order" type="button" class="btn btn-primary">Place Order</button>
                </div>
            </div>
            </div>
        </div>
        {{-- <div :class="cartOpen ? 'translate-x-0 ease-out' : 'translate-x-full ease-in'" class="fixed right-0 top-0 max-w-xs w-full h-full px-6 py-4 transition duration-300 transform overflow-y-auto bg-white border-l-2 border-gray-300">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl font-medium text-gray-700">Your cart</h3>
                <button @click="cartOpen = !cartOpen" class="text-gray-600 focus:outline-none">
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <hr class="my-3">
            <div class="flex justify-between mt-6">
                <div class="flex">
                    <img class="h-20 w-20 object-cover rounded" src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80" alt="">
                    <div class="mx-3">
                        <h3 class="text-sm text-gray-600">Mac Book Pro</h3>
                        <div class="flex items-center mt-2">
                            <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                            <span class="text-gray-700 mx-2">2</span>
                            <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
                <span class="text-gray-600">20$</span>
            </div>
            <a class="flex items-center justify-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                <span>Place Order</span>
                <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div> --}}


        <main class="my-8">

            <meta name="csrf-token" content="{{csrf_token()}}">

            <div class="container mx-auto px-6">
                <h3 class="text-gray-700 text-2xl font-medium">Best Selling Watch</h3>
                <span class="mt-3 text-sm text-gray-500">{{ $count_watch }} products</span>

                <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                    {{-- <input type="hidden" id="product_quantity" name="quantity" value="1"> --}}
                    @foreach($product as $p)
                    <div class="add-to-cart w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">

                        <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url({{$p->product_image}})">
                            <button id="btn_add_cart" type="button" class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7
                                    13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </button>
                        </div>
                        <div class="px-5 py-3">
                            <input class="product_name" type="hidden" id="product_name" name="product_name" value="{{ $p->product_name }}">
                            <input class="product_price" type="hidden" id="product_price" name="product_price" value="{{ $p->product_price }}">
                            <input type="hidden" id="product_id" name="product_id" value="{{ $p->product_id }}">
                            <input type="hidden" id="product_image" name="product_image" value="{{ $p->product_image }}">
                            <h3 class="text-gray-700 uppercase" >{{ $p->product_name }}</h3>
                            <span id="product_price" class="text-gray-500 mt-2" >${{ $p->product_price }}</span>
                        </div>

                    </div>
                    @endforeach
                </div>

                <div class="flex justify-center">
                    <div class="flex rounded-md mt-8">
                        <a href="#" class="py-2 px-4 leading-tight bg-white border border-gray-200 text-blue-700 border-r-0 ml-0 rounded-l hover:bg-blue-500 hover:text-white"><span>Previous</a></a>
                        <a href="#" class="py-2 px-4 leading-tight bg-white border border-gray-200 text-blue-700 border-r-0 hover:bg-blue-500 hover:text-white"><span>1</span></a>
                        <a href="#" class="py-2 px-4 leading-tight bg-white border border-gray-200 text-blue-700 border-r-0 hover:bg-blue-500 hover:text-white"><span>2</span></a>
                        <a href="#" class="py-2 px-4 leading-tight bg-white border border-gray-200 text-blue-700 border-r-0 hover:bg-blue-500 hover:text-white"><span>3</span></a>
                        <a href="#" class="py-2 px-4 leading-tight bg-white border border-gray-200 text-blue-700 rounded-r hover:bg-blue-500 hover:text-white"><span>Next</span></a>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-gray-200">
            <div class="container mx-auto px-6 py-3 flex justify-between items-center">
                <a href="#" class="text-xl font-bold text-gray-500 hover:text-gray-400">Brand</a>
                <p class="py-2 text-gray-500 sm:py-0">All rights reserved</p>
            </div>
        </footer>
    </div>
    </body>

{{-- </x-app-layout> --}}
@endsection

@push('scripts')

<script type="text/javascript">

$(document).ready(function() {

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var token = "{{ csrf_token() }}";

    $('#place_order').click(function(e){
        e.preventDefault();

        cart = JSON.stringify(cart);
        console.log('after stringify ' + cart);

        $.ajax({
            type: "POST",
            url: "{{ url('/place-order') }}",
            data: { token: token, data: cart},
            success:function(data){

                console.log('return success : ' + JSON.stringify(data.data));
                data = JSON.stringify(data.data);
                window.location = "{{ url('response/order') }}" + "/" + data;
            },
            error:function(){

                console.log('return fail');
                window.location = "{{ url('response/order') }}" + "/null" ;
            }
        });
    });

    var shoppingCart = (function() {
        // =============================
        // Private methods and propeties
        // =============================
        cart = [];

        // Constructor
        function Item(name, price, count, id, img) {
            this.name = name;
            this.price = price;
            this.count = count;
            this.id = id;
            this.img = img;
        }

        // Save cart
        function saveCart() {
            sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
        }

            // Load cart
        function loadCart() {
            cart = JSON.parse(sessionStorage.getItem('shoppingCart'));
        }
        if (sessionStorage.getItem("shoppingCart") != null) {
            loadCart();
        }


        // =============================
        // Public methods and propeties
        // =============================
        var obj = {};

        // Add to cart
        obj.addItemToCart = function(name, price, count, id, img) {
            for(var item in cart) {
            if(cart[item].id == id) {
                cart[item].count ++;
                saveCart();
                return;
            }
            }
            var item = new Item(name, price, count, id, img);
            cart.push(item);
            saveCart();
        }

        // Set count from item
        obj.setCountForItem = function(id, count) {
            for(var i in cart) {
            if (cart[i].id == id) {
                cart[i].count = count;
                break;
            }
            }
        };

        // Remove item from cart
        obj.removeItemFromCart = function(id) {
            console.log('removeItemFromCart ' + JSON.stringify(cart));
            for(var item in cart) {
                if(cart[item].id == id) {
                    cart[item].count --;
                    if(cart[item].count == 0) {
                        cart.splice(item, 1);
                }
                break;
                }
            }
            console.log(' after removeItemFromCart ' + JSON.stringify(cart));
            saveCart();
        }

        // Remove all items from cart
        obj.removeItemFromCartAll = function(id) {
            for(var item in cart) {
                if(cart[item].id == id) {
                    cart.splice(item, 1);
                    break;
                }
            }
            saveCart();
        }

        // Clear cart
        obj.clearCart = function() {
            cart = [];
            saveCart();
        }

        // Count cart
        obj.totalCount = function() {
            var totalCount = 0;
            for(var item in cart) {
            totalCount += cart[item].count;
            }
            return totalCount;
        }

        // Total cart
        obj.totalCart = function() {
            var totalCart = 0;
            for(var item in cart) {
            totalCart += cart[item].price * cart[item].count;
            }
            return Number(totalCart.toFixed(2));
        }

        // List cart
        obj.listCart = function() {

            var cartCopy = [];

            console.log(cart);

            for(i in cart) {
            item = cart[i];
            itemCopy = {};
            for(p in item) {
                itemCopy[p] = item[p];

            }
            itemCopy.total = Number(item.price * item.count).toFixed(2);
            cartCopy.push(itemCopy)
            }
            return cartCopy;
        }

        return obj;
    })();


    // *****************************************
    // Triggers / Events
    // *****************************************
    $('.add-to-cart').click(function(event) {

        event.preventDefault();

        var productId = $(this).find('[name=product_id]').val();
        var productPrice = Number($(this).find('[name=product_price]').val());
        var productName = $(this).find('[name="product_name"]').val();
        var productImage = $(this).find('[name=product_image]').val();

        console.log(productId, productName, productPrice, productImage);
        shoppingCart.addItemToCart(productName, productPrice, 1, productId, productImage);
        displayCart();
        alert('Added to cart!');
    });


    function displayCart() {
        var cartArray = shoppingCart.listCart();
        var output = "";
        console.log('cart Array ' + JSON.stringify(cartArray));
        for(var i in cartArray) {
            output += "<tr>"
            + "<td>" + cartArray[i].name + "</td>"
            + "<td>$(" + cartArray[i].price + ")</td>"
            + "<td><div class='input-group'><button class='minus-item input-group-addon btn btn-primary' data-name=" + cartArray[i].id + ">-</button>"
            + "<input type='number' class='item-count form-control' data-name='" + cartArray[i].id + "' value='" + cartArray[i].count + "'>"
            + "<button class='plus-item btn btn-primary input-group-addon' data-name=" + cartArray[i].id + ">+</button></div></td>"
            + "<td><button class='delete-item btn btn-danger' data-name=" + cartArray[i].id + ">X</button></td>"
            + " = "
            + "<td>$" + cartArray[i].total + "</td>"
            +  "</tr>";
        }
        $('.show-cart').html(output);
        $('.total-cart').html(shoppingCart.totalCart());
        $('.total-count').html(shoppingCart.totalCount());
    }

    // Delete item button

    $('.show-cart').on("click", ".delete-item", function(event) {
        var name = Number($(this).data('name'));
        shoppingCart.removeItemFromCartAll(name);
        displayCart();
    })

    // -1
    $('.show-cart').on("click", ".minus-item", function(event) {
        var id = Number($(this).data('name'));
        console.log("id minus : " + id);
        shoppingCart.removeItemFromCart(id);
        displayCart();
        })
        // +1
        $('.show-cart').on("click", ".plus-item", function(event) {
        var id = Number($(this).data('name'));
        console.log("id plus : " + id);
        shoppingCart.addItemToCart('', '', '',id);
        displayCart();
    })

    // Item count input
    $('.show-cart').on("change", ".item-count", function(event) {
        var id = NUmber($(this).data('name'));
        var count = Number($(this).val());
        console.log("count : " + count);
        shoppingCart.setCountForItem(id, count);
        displayCart();
    });

    displayCart();

});

</script>
@endpush

