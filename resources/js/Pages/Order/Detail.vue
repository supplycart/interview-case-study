<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import PriceDisplay from '@/Components/PriceDisplay.vue';

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
                    <div class="p-6 text-gray-900">
                        <div
                            class="overflow-x-auto rounded-lg border border-gray-200 shadow-md"
                        >
                            <table class="w-full border-collapse text-left">
                                <thead
                                    class="bg-gray-100 text-sm uppercase text-gray-700"
                                >
                                    <tr>
                                        <th class="border-b px-4 py-3">Name</th>
                                        <th class="border-b px-4 py-3">
                                            Brand
                                        </th>
                                        <th class="border-b px-4 py-3">
                                            Category
                                        </th>
                                        <th class="border-b px-4 py-3">
                                            Price
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr
                                        v-for="(row, index) in productList"
                                        :key="index"
                                        class="border-b hover:bg-gray-50"
                                    >
                                        <td class="cursor-pointer px-4 py-3">
                                            <NavLink
                                                :href="`/product/order/${row.productId}`"
                                                class="font-medium text-indigo-600 hover:text-indigo-500"
                                            >
                                                {{ row.productName }}
                                            </NavLink>
                                        </td>
                                        <td class="cursor-pointer px-4 py-3">
                                            {{ row.brandName }}
                                        </td>
                                        <td class="cursor-pointer px-4 py-3">
                                            {{ row.categoryName }}
                                        </td>
                                        <td class="cursor-pointer px-4 py-3">
                                            <PriceDisplay
                                                :price="row.productPrice"
                                            />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
