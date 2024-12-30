<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PaginationLinks from '@/Components/PaginationLinks.vue';

defineProps({
    orders: Object,
});

function formatPrice(price) {
    return (Math.round(price * 100) / 100).toFixed(2);
}

const getDate = (date) =>
    new Date(date).toLocaleString('en-us', {
        dateStyle: 'medium',
        timeStyle: 'medium',
    });

const getReadableOrderStatus = (orderStatus) => {
    if (orderStatus === 1) {
        return 'Processing';
    } else if (orderStatus === 2) {
        return 'Completed';
    } else {
        return label;
    }
};
</script>

<template>
    <Head title="Order History" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Order History
            </h2>
        </template>

        <div class="mx-auto max-w-7xl py-12 sm:px-6 lg:px-8">
            <div
                class="flex justify-center overflow-hidden bg-white px-4 py-8 shadow-sm sm:rounded-lg"
            >
                <div class="flex-1 overflow-x-auto">
                    <table
                        class="w-full rounded-lg text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400"
                    >
                        <thead
                            class="bg-gray-50 text-base text-gray-700 marker:uppercase dark:bg-slate-700 dark:text-gray-400"
                        >
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Order Identifier
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Order Total
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Order Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created Time
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-base">
                            <tr
                                v-for="(order, index) in orders.data"
                                :key="order.id"
                                class="bg-white dark:border-gray-700 dark:bg-gray-800"
                                :class="{
                                    'border-b':
                                        index !== orders.data.length - 1,
                                }"
                            >
                                <th
                                    scope="row"
                                    class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white"
                                >
                                    {{ order.order_identifier }}
                                </th>
                                <td class="px-6 py-4">
                                    RM {{ formatPrice(order.net_price) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{
                                        getReadableOrderStatus(
                                            order.order_status,
                                        )
                                    }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ getDate(order.created_at) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mx-4 my-4 flex justify-start gap-8">
                        <PaginationLinks :paginator-links="orders.links" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
