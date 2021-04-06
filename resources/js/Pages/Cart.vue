<template>

    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cart
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 relative">
                        <div v-if="isOverlay" class="absolute w-full h-full block top-0 left-0 bg-white opacity-75 z-50">
                        </div>
                        <div v-if="cartNotEmpty" class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="border-collapse w-full">
                                            <tbody>
                                            <CartProductListItem
                                                v-for="product in products"
                                                :key="product.id"
                                                :product="product"
                                                @updateCart="updateCartItem"
                                            ></CartProductListItem>
                                            </tbody>
                                        </table>

                                        <div class="my-4 mt-6 -mx-2 lg:flex justify-end">
                                            <div class="lg:px-2 lg:w-1/2">
                                                <OrderSummary
                                                    :actionRoute="actionRoute"
                                                    :actionText="actionText"
                                                    :subtotal="subtotal"
                                                >
                                                </OrderSummary>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else class="my-4 mt-6 -mx-2 lg:flex justify-center">
                            <div class="mt-3 lg:px-2 lg:w-1/3 text-center sm:mt-0 sm:ml-4 sm:text-left">

                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 text-center">Your shopping cart is empty!</p>
                                </div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    <a
                                        :href="route('product.index')"
                                        class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none"
                                    >
                                        <span class="ml-2 mt-5px">Shop now!</span>
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
import CartProductListItem from '@/Components/Products/Cart_ListItem'
import OrderSummary from '@/Components/Orders/Summary'

export default {
    components: {
        OrderSummary,
        CartProductListItem,
        BreezeAuthenticatedLayout,
    },
    created() {
        this.read();
    },
    data() {
        return {
            actionRoute: route('user.checkout'),
            actionText: 'Proceed to checkout',
            isOverlay: false,
            products: [],
        };
    },
    computed: {
        cartNotEmpty() {
            return this.subtotal > 0
                ? true
                : false;
        },
        subtotal() {
            return this.products.reduce(
                (sum, item) => sum + Number(item.price * item.incart_qty),
                0
            ).toFixed(2);
        },
    },
    methods: {
        async read() {
            await axios
                .get(route('api.cart.read'))
                .then(response => {
                    this.products = response.data;
                });
        },
        async updateCartItem(productId, quantity) {
            this.isOverlay = true;
            await axios.post(route('api.cart.update'), {
                product_id: productId,
                quantity,
            })
                .then(response => {
                    setTimeout(() => {
                        this.isOverlay = false;
                    }, 500);
                });
        },
    },
}
</script>
