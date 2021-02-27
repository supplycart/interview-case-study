<template>
    <app-layout :cart_items_count="cart_items_count">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Orders
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                    <table class="table-auto w-full" v-if="Object.keys(orders).length > 0">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2 w-3/12">Address</th>
                            <th class="px-4 py-2">Total</th>
                            <th class="px-4 py-2">Quantity Order</th>
                            <th class="px-4 py-2">Date</th>
                        </tr>
                        </thead>
                        <tbody v-for="(order_item, index) in orders">
                        <tr>
                            <td class="border px-4 py-2">{{ index + 1 }}</td>
                            <td class="border px-4 py-2">{{ order_item.firstname }} {{ order_item.lastname }}</td>
                            <td class="border px-4 py-2">{{ order_item.address }}</td>
                            <td class="border px-4 py-2">{{ order_item.sign }} {{ order_item.total }}</td>
                            <td class="border px-4 py-2">{{ order_item.products.length }} items</td>
                            <td class="border px-4 py-2">{{ order_item.created_at }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <h3 v-else >You don't have orders yet.</h3>

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
                user_id: 0,
                cart_items_count: 0,
                carts: {},
                currency: 'MYR',
                orders: {}
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
            if (this.$page.user) {
                this.user_id = this.$page.user.id;
            }
            this.getOrders();
        },
        methods: {
            async getOrders() {
                const auth = {
                    headers: {
                        Accept: 'application/json',
                        Authorization: 'Bearer ' + this.$page.props.user_token,
                    },
                    params: {
                        user_id: this.$page.props.user.id,
                        currency: this.currency
                    }
                };
                axios.get('/api/get_user_orders', auth  ).then(response => {
                    if (response.data.success) {
                        this.orders = response.data.orders;
                    }
                });
            },
        }
    }
</script>
