<template>
    <app-layout :cart_items_count='cart_items_count'>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Menu
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div
                        class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-5">
                        <!--Card 1-->
                        <div class="rounded overflow-hidden shadow-lg" v-for="product in products">
                            <img class="w-full" :src="product.image_url" :alt="product.name">
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">{{ product.name }}</div>
                                <div class="text-l mb-2"><span>{{ product.sign }}{{ product.price }}</span></div>
<!--                                <p class="text-gray-700 text-base">-->
<!--                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla!-->
<!--                                    Maiores et perferendis eaque, exercitationem praesentium nihil.-->
<!--                                </p>-->
                                <p></p>
                            </div>
                            <div class="px-6 pt-4 pb-2">
                                <a href="#" class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-3 mr-2 mb-2 rounded" @click="addToCart($event, product.id)" ><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
                                <a href="#" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded" @click="buyNow($event, product.id)">Buy now<span><i class="ion-ios-cart ml-1"></i></span></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from "../Layouts/AppLayout"
    import Welcome from "../Jetstream/Welcome";

    export default {
        props: [],
        components: {
            Welcome,
            AppLayout,
        },
        data() {
            return {
                cart_items_count: 0,
                carts: {},
                products: {},
                currency: 'MYR'
            }
        },
        mounted() {
            if ( this.$cookies.get('cart_items_count') !== null ){
                this.cart_items_count = this.$cookies.get('cart_items_count');
            }
            if ( this.$cookies.get('carts') !== null ){
                this.carts = this.$cookies.get('carts');
            }
            if ( this.$cookies.get('currency') !== null ){
                this.currency = this.$cookies.get('currency');
            }
            this.getProducts();
        },
        methods: {

            async getProducts() {
                const params = {
                    currency: this.currency
                };
                axios.get('/api/products', { params }).then(response => {
                    this.products = response.data;
                });
            },

            addToCart(event, product_id) {
                event.preventDefault();
                this.addItemInCart(product_id);
            },

            buyNow(event, product_id) {
                event.preventDefault();
                this.addItemInCart(product_id);
                this.$inertia.visit('/cart');
            },

            addItemInCart(product_id) {
                this.cart_items_count++;
                this.$cookies.set('cart_items_count', this.cart_items_count);

                if ( Object.keys(this.carts).length > 0 ) {
                    let found = false;

                    for (let product_id_key in this.carts) {
                        if (product_id_key == product_id) {
                            this.carts[product_id_key]++;
                            found = true;
                        }
                    }
                    if ( ! found) {
                        this.carts = Object.assign(this.carts, {
                            [product_id]: 1
                        });
                    }

                } else {
                    this.carts = Object.assign(this.carts, {
                        [product_id]: 1
                    });
                }
                this.$cookies.set('carts', this.carts);
            }
        }
    }

</script>
