<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="px-10">
            <div class="w-full">
                <div class="grid grid-cols-2 gap-x-6 gap-y-10 px-2sm:grid-cols-3 sm:px-8 lg:mt-16 lg:grid-cols-4 lg:gap-x-4 lg:px-0">
                    <div class="flex flex-col items-center p-5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <img class="h-36 w-64 mb-3 shadow-lg" src="/images/product.webp" alt="Product"/>
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Product</h5>
                        <span class="text-sm text-gray-500 dark:text-gray-400">View all the products</span>
                        <div class="flex mt-4 space-x-3 md:mt-6">
                            <Link :href="route('products.index')" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">View Product</Link>
                        </div>
                    </div>
                    <div class="flex flex-col items-center p-5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <img class="h-36 w-64 mb-3 shadow-lg" src="/images/cart.webp" alt="Product"/>
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Cart</h5>
                        <span class="text-sm text-gray-500 dark:text-gray-400">View all the items in cart.</span>
                        <div class="flex mt-4 space-x-3 md:mt-6">
                            <Link :href="route('carts.index')" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">View Cart</Link>
                        </div>
                    </div>
                    <div class="flex flex-col items-center p-5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <img class="h-36 w-64 mb-3 shadow-lg" src="/images/order.avif" alt="Product"/>
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Order</h5>
                        <span class="text-sm text-gray-500 dark:text-gray-400">View all the orders.</span>
                        <div class="flex mt-4 space-x-3 md:mt-6">
                            <Link :href="route('orders.index')" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">View Order</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
