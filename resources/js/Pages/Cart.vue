<template>
    <app-layout :cart_items_count='cart_items_count'>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cart
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                    <table class="table-auto w-full">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 w-20"> </th>
                            <th class="px-4 py-2"> </th>
                            <th class="px-4 py-2 w-6/12">Product</th>
                            <th class="px-4 py-2">Price</th>
                            <th class="px-4 py-2">Quantity</th>
                            <th class="px-4 py-2">Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="cart_item in cart_items">
                            <td class="border px-4 py-2"><a class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" href="#" @click="removeItem($event, cart_item.id)">x</a></td>
                            <td class="border px-4 py-2"><img :src="cart_item.image_url" :alt="cart_item.name" class="transform scale-75"></td>
                            <td class="border px-4 py-2">
                                <div class="font-bold text-xl mb-2">{{ cart_item.name }}</div>
                                <div class="text-l mb-2">{{ cart_item.description }}</div>
                            </td>
                            <td class="border px-4 py-2">
                                {{cart_item.sign}}{{cart_item.price}}
                            </td>
                            <td class="border px-4 py-2">
                                <input
                                    type="number"
                                    name="quantity"
                                    class="quantity form-control input-number"
                                    :value="cart_item.quantity"
                                    min="1" max="100"
                                    @change="onQuantityChange($event, cart_item.id, $event.target.value)">
                            </td>
                            <td class="border px-4 py-2">
                                {{cart_item.sign}}{{cart_item.total}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="border px-4 py-2 text-right">Total</td>
                            <td class="border px-4 py-2">
                                <span>{{sign}}{{total}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-right">
                                <inertia-link href="/checkout" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" >Proceed to Checkout</inertia-link>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'

    export default {
        components: {
            AppLayout,
            Welcome,
        },
        data() {
            return {
                cart_items_count: 0,
                carts: {},
                cart_items: {},
                subtotal: 0,
                delivery: 0,
                discount: 0,
                total: 0,
                sign: 0,
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
            this.getCart();
        },
        methods: {
            async getCart() {
                const params = {
                    carts: this.carts,
                    currency: this.currency
                };
                axios.get('/api/get_cart', { params }).then(response => {
                    if (response.data.success) {
                        this.cart_items = response.data.products;
                        this.subtotal = response.data.subtotal;
                        this.delivery = response.data.delivery;
                        this.discount = response.data.discount;
                        this.total = response.data.total;
                        this.sign = response.data.sign;
                    }
                });
            },
            async onQuantityChange(event, product_id, val) {
                event.preventDefault();

                let diff = this.carts[product_id] - val;
                for (let product_id_key in this.carts) {
                    if (product_id_key == product_id) {
                        this.carts[product_id] = val;
                    }
                }
                this.cart_items_count = this.cart_items_count - diff;
                this.$cookies.set('cart_items_count', this.cart_items_count);
                this.$cookies.set('carts', this.carts);

                await this.getCart();
            },
            async removeItem(event, pizza_id) {
                event.preventDefault();

                this.cart_items_count = this.cart_items_count - this.carts[pizza_id];
                this.$cookies.set('cart_items_count', this.cart_items_count);
                delete this.carts[pizza_id];
                this.$cookies.set('carts', this.carts);

                this.getCart();
            },
        }
    }
</script>
