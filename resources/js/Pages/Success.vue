<template>
    <app-layout :cart_items_count='cart_items_count'>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Success
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <div class="max-w-6xl mx-auto sm:px-6 sm:py-6 lg:px-6 lg:py-6">

                        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-2">
                                <div class="p-6">
                                    <div class="flex items-center">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                        <div class="ml-4 text-lg leading-7 font-semibold"><a class="text-gray-900 dark:text-white">Order successfully created</a></div>
                                    </div>

                                    <div class="ml-12">
                                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                            <p>In the near future we will deliver your pizza to the specified address.</p>
                                            <p>If you want, you can <inertia-link href="/" class="color-blue hover:underline">create another order</inertia-link>.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

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
        },
    }
</script>
