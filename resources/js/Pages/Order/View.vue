<script setup>
import NavLink from '@/Components/NavLink.vue';
import PriceDisplay from '@/Components/PriceDisplay.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const { orderList } = defineProps({ orderList: Array });
</script>

<template>
    <Head title="Order" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Order
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h1 v-if="orderList.length <= 0">
                            You have not made an order.
                        </h1>
                        <div v-else>
                            <div
                                class="overflow-x-auto rounded-lg border border-gray-200 shadow-md"
                            >
                                <table class="w-full border-collapse text-left">
                                    <thead
                                        class="bg-gray-100 text-sm uppercase text-gray-700"
                                    >
                                        <tr>
                                            <th class="border-b px-4 py-3"></th>
                                            <th class="border-b px-4 py-3">
                                                Order ID
                                            </th>
                                            <th class="border-b px-4 py-3">
                                                Total Price
                                            </th>
                                            <th class="border-b px-4 py-3">
                                                Created At
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr
                                            v-for="(row, index) in orderList"
                                            :key="index"
                                            class="border-b hover:bg-gray-50"
                                        >
                                            <td class="px-4 py-3">
                                                <NavLink
                                                    :href="`/order/${row.orderId}`"
                                                    class="font-medium text-indigo-600 hover:text-indigo-500"
                                                >
                                                    View
                                                </NavLink>
                                            </td>
                                            <td
                                                class="cursor-pointer px-4 py-3"
                                            >
                                                {{ row.orderId }}
                                            </td>
                                            <td
                                                class="cursor-pointer px-4 py-3"
                                            >
                                                <PriceDisplay
                                                    :price="row.totalPrice"
                                                />
                                            </td>
                                            <td
                                                class="cursor-pointer px-4 py-3"
                                            >
                                                {{ row.createdAt }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
