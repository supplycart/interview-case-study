<template>
    <app-layout :cart_items_count="cart_items_count">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Checkout
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray overflow-hidden">
                    <form action="#">
                        <div class="mt-10 sm:mt-0">
                            <div class="md:grid md:grid-cols-3 md:gap-6">
                                <div class="md:col-span-1">
                                    <div class="px-4 py-5 bg-gray sm:p-6">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900">Billing Details</h3>
                                        <p class="mt-1 text-sm text-gray-600">
                                            Use a permanent address where you can receive mail.
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-5 md:mt-0 md:col-span-2">
                                    <div class="shadow overflow-hidden sm:rounded-md">
                                        <div class="px-4 py-5 bg-white sm:p-6">
                                            <div class="grid grid-cols-12 gap-6">
                                                <div class="col-span-6 sm:col-span-6">
                                                    <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
                                                    <input required type="text" v-model="firstname" name="first_name" id="first_name" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                <div class="col-span-6 sm:col-span-6">
                                                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last name</label>
                                                    <input required type="text" v-model="lastname" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                <div class="col-span-12">
                                                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                                    <input required type="text" v-model="address" name="address" id="address" autocomplete="street-address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                <div class="col-span-6 sm:col-span-6 lg:col-span-6">
                                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                                    <input required type="text" v-model="phone" name="phone" id="phone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                <div class="col-span-6 sm:col-span-6 lg:col-span-6" v-if="!$page.props.user">
                                                    <label for="email_address" class="block text-sm font-medium text-gray-700">Email address</label>
                                                    <input required type="text" v-model="email" name="email_address" id="email_address" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                <div class="col-span-6 sm:col-span-6 lg:col-span-6" v-if="!$page.props.user && is_create_account == 1" >
                                                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                                    <input required type="password" v-model="password" name="password" id="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                            </div>
                                        </div>
    <!--                                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">-->
    <!--                                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">-->
    <!--                                                Save-->
    <!--                                            </button>-->
    <!--                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="hidden sm:block" aria-hidden="true">
                            <div class="py-5">
                                <div class="border-t border-gray-200"></div>
                            </div>
                        </div>

                        <div class="mt-10 sm:mt-0">
                            <div class="md:grid md:grid-cols-3 md:gap-6">
                                <div class="md:col-span-1">
                                    <div class="px-4 py-5 bg-gray sm:p-6">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900">Payment</h3>
                                        <p class="mt-1 text-sm text-gray-600">
                                            Cart Total - info
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-5 md:mt-0 md:col-span-2">
                                    <div class="shadow overflow-hidden sm:rounded-md">
                                        <div class="px-4 py-5 bg-white sm:p-6">
                                            <div class="grid grid-cols-12 gap-6">
                                                <div class="col-span-6 sm:col-span-6">
                                                    <label for="total" class="block text-sm font-medium text-gray-700">Total ({{ sign }})</label>
                                                    <input required type="text" v-model="total" name="total" id="total" readonly autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                            <button type="button" @click="createOrder($event)" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Place an order
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
                subtotal: 0,
                delivery: 0,
                discount: 0,
                total: 0,
                sign: 0,
                currency: 'MYR',

                is_create_account: 1,

                firstname: '',
                lastname: '',
                address: '',
                phone: '',
                email: '',
                password: '',

                errors: {},
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

            if (this.$page.props.user) {
                this.firstname = this.$page.props.user.name;
                this.email = this.$page.props.user.email;
                this.is_create_account = 3;
            }
            if (this.cart_items_count == 0){
                this.$inertia.visit('/');
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
                        this.subtotal = response.data.subtotal;
                        this.delivery = response.data.delivery;
                        this.discount = response.data.discount;
                        this.total = response.data.total;
                        this.sign = response.data.sign;
                    }
                });
            },
            async createOrder(event) {
                event.preventDefault();
                const params = {
                    carts: this.carts,
                    firstname: this.firstname,
                    lastname: this.lastname,
                    address: this.address,
                    phone: this.phone,
                    email: this.email,
                    is_create_account: this.is_create_account,
                    password: this.password,
                };
                axios.post('/api/checkout', params).then(response => {
                    console.log(response.data);
                    if (response.data.success) {
                        this.carts = {};
                        this.cart_items_count = 0;
                        this.$cookies.set('carts', this.carts);
                        this.$cookies.set('cart_items_count', this.cart_items_count);
                        this.$inertia.visit('/success');

                    } else {
                        this.errors = response.data.errors;
                        alert('Some error');
                    }
                });
            }
        }
    }
</script>
