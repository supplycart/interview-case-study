<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Product List</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <style>
            .d-none {
                display: none;
            }
        </style>

        <script>
            const CSRF = '{{ csrf_token() }}';
            const URL_ADD_PRODUCT_TO_CART = '{{ route('cart_add') }}';
            let isCartFilled = '{{ $isCartFilled }}';

            window.addEventListener('load', ProductUiHandler);

            function AjaxHelper(url, successCallback, failedCallback) {
                this.post = post;
                this.removeContentType = removeContentType;

                let fetchOpts_ = {
                    method: 'POST',
                    headers: {
                        'Content-type' : 'application/x-www-form-urlencoded; charset=URF-8',
                        'X-CSRF-TOKEN' : CSRF
                    }
                };
                let isResponseStatusSucess_ = false;
                let statusCode_ = -1;

                function post(param) {
                    fetchOpts_.body = param;

                    request_();
                }

                function removeContentType() {
                    delete fetchOpts_.headers['Content-type'];
                }

                function callbackToFailed_(jsonReturn) {
                    if (typeof failedCallback === 'function') {
                        failedCallback(jsonReturn, statusCode_);
                    }
                }

                function callbackToSuccess_(jsonReturn) {
                    if (typeof successCallback === 'function') {
                        successCallback(jsonReturn, statusCode_);
                    }
                }

                function convertResponseToJson_(response) {
                    response.json().then(convertResponseToJsonSuccess_);
                }

                function convertResponseToJsonSuccess_(dataReturn) {
                    if (isResponseStatusSucess_ === true) {
                        callbackToSuccess_(dataReturn);
                    } else {
                        callbackToFailed_(dataReturn);
                    }
                }

                function processFailedStatus_(response) {
                    isResponseStatusSucess_ = false;

                    convertResponseToJson_(response);
                }

                function processSuccessStatus_(response) {
                    isResponseStatusSucess_ = true;

                    convertResponseToJson_(response);
                }

                function request_() {
                    fetch(url, fetchOpts_).then(requestSuccess_).catch(requestFailed_);
                }

                function requestFailed_(response) {
                    console.error('Request send failed!');

                    callbackToFailed_({data: ['Client Request Failed.'], dataType: 'error'});
                }

                function requestSuccess_(response) {
                    statusCode_ = response.status;

                    if ((statusCode_ >=200 && statusCode_ < 300) === true) {
                        processSuccessStatus_(response);
                    } else {
                        processFailedStatus_(response);
                    }
                }
            }

            function ProductUiHandler() {
                initClass_();

                function initClass_() {
                    if (isCartFilled == 1) {
                        document.getElementById('order-place-form').classList.remove('d-none');
                    }

                    assignListener_();
                }

                function assignListener_() {
                    let products_ = document.getElementsByClassName('js-products');

                    for (let i = 0; i < products_.length; i++) {
                        products_[i].addEventListener('click', addToCartBtnClicked_);
                    }
                }

                function addToCartBtnClicked_(e) {
                    let productID = e.currentTarget.getAttribute('data-product-id');
                    executeAddToCartProcess_(productID);
                }

                function executeAddToCartProcess_(productID) {
                    let addToCartData_ = null;
                    
                    createAddToCartForm__();
                    addToCart__(addToCartData_);

                    function addToCart__(data) {
                        let ajaxHelper_ = new AjaxHelper(URL_ADD_PRODUCT_TO_CART, addToCartOK__, addToCartFailed__);

                        ajaxHelper_.removeContentType();
                        ajaxHelper_.post(data);
                    }

                    function addToCartFailed__(data, statusCode) {
                        alert('Sorry, please try again later.');
                    }

                    function addToCartOK__(responseData) {
                        alert('Added to carts.');
                        document.getElementById('order-place-form').classList.remove('d-none');
                    }

                    function createAddToCartForm__() {
                        addToCartData_ = new FormData;
                        addToCartData_.append('product_id', productID);
                    }
                }
            }
        </script>
    </head>
    <body>
        <form action="{{ route('user_logout') }}" method="get">
            <input type="submit" value="Logout" />
        </form>
        <form action="{{ route('order_history') }}" method="get">
            <input type="submit" value="Order History" />
        </form>
        <form id="order-place-form" action="{{ route('order_place') }}" class="d-none" method="post">
            @csrf
            <input type="submit" value="Place Order" />
        </form>
        <div>
            <div>Product Name || Brand || Category || Price</div>
        </div>
        @foreach ($products as $currProduct)
            <div class="js-products" data-product-id="{{ $currProduct['product_id'] }}">
                <div>{{ $currProduct['product_name'] }} || {{ $currProduct['brand_name'] }} || {{ $currProduct['category'] }} || {{ $currProduct['product_price'] }}</div>
            </div>
        @endforeach
    </body>
</html>
