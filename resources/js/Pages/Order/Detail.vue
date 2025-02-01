<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const { order, productList } = defineProps({
    order: {
        orderId: Number,
        totalPrice: Number,
        createdAt: String,
    },
    productList: Array,
});
const { orderId, totalPrice, createdAt } = order;
</script>

<template>
    <Head title="Order" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Order ID: {{ orderId }}
            </h2>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Total Price: {{ totalPrice }}
            </h2>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Order Timestamp: {{ createdAt }}
            </h2>
        </template>

        <!-- TODO: show list of product within this order -->
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Product list here</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
