<template>
    <Head title="Success"></Head>
    <AuthenticatedLayout>
        <div class="flex space-x-3">
            <Link :href="route('dashboard')" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center hover:underline"> &#x2190; Back</Link>
        </div>

        <div class="mx-auto max-w-screen-lg px-4 py-8 sm:px-8">
            <div class="py-5">
                <h2 class="font-semibold text-3xl text-center text-gray-700">Order History</h2>
                <h6 class="text-xl text-center text-gray-500">View all your orders.</h6>
            </div>
            <div class="overflow-y-hidden rounded-lg border">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-600 text-left text-xs font-semibold uppercase tracking-widest text-white">
                                <th class="px-5 py-3">Order ID</th>
                                <th class="px-5 py-3">Total Price</th>
                                <th class="px-5 py-3">Status</th>
                                <th class="px-5 py-3">Payment</th>
                                <th class="px-5 py-3">Created at</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-500">
                            <tr v-for="(order, index) in orders" :key="index">
                                <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                    <p class="whitespace-no-wrap">SO0000{{ order.id }}</p>
                                </td>
                                <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                    {{ order.total_price }}
                                </td>
                                <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                    {{ statusText(order) }}
                                </td>
                                <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                    {{ paymentStatusText(order) }}
                                </td>
                                <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                    {{  order.created_at }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    orders: Object,
    statusArray: Object,
    paymentStatusArray: Object,

});

const orders = props.orders;

const statusText = computed(() => {
    return (order) => props.statusArray[order.status];
});

const paymentStatusText = computed(() => {
    return (order) => props.paymentStatusArray[order.status];
});
</script>
