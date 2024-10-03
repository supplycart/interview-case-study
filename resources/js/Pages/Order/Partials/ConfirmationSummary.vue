<template>
    <section class="bg-white py-8 antialiased md:py-16">
        <div class="mx-auto max-w-2xl px-4 2xl:px-0">
            <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl mb-2">Thanks for your order!</h2>
            <p class="text-gray-500 mb-6 md:mb-8">Your order <a href="#" class="font-bold text-gray-900 hover:underline">{{ order.order_number }}</a> will be processed within 24 hours during working days. We will notify you by email once your order has been shipped.</p>
            <div class="space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-6 mb-6 md:mb-8">
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500">Date</dt>
                    <dd class="font-medium text-gray-900 sm:text-end">{{ formatDate(order.created_at) }}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500">Payment Method</dt>
                    <dd class="font-medium text-gray-900 sm:text-end">Card</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500">Name</dt>
                    <dd class="font-medium text-gray-900 sm:text-end">{{ order.address.name }}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500">Address</dt>
                    <dd class="font-medium text-gray-900 sm:text-end">
                        {{ order.address.address }}<br>
                        {{ order.address.city }}, {{ order.address.state }}<br>
                        {{ order.address.zip_code }}
                    </dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500">Phone</dt>
                    <dd class="font-medium text-gray-900 sm:text-end">{{ order.address.phone }}</dd>
                </dl>
            </div>
            <div class="flex justify-center items-center space-x-4">
                <link
                    :href="route('order.show', order.id)"
                    v-html="'Track your order'"
                    class="cursor-pointer bg-indigo-500 border-2 hover:bg-indigo-800 flex gap-2 items-center justify-center text-white focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center"
                />
                <Link
                    :href="route('products.index')"
                    v-html="'Continue shopping'"
                    class="cursor-pointer border-2 hover:border-indigo-600 flex gap-2 items-center justify-center text-black border-solid focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center"
                />
            </div>
        </div>
    </section>
</template>

<script setup>
import { defineProps } from 'vue'
import { Link } from '@inertiajs/vue3';
import { formatDate } from "../../../dateFormatter.js";

const props = defineProps({
    order: Object
})
</script>
