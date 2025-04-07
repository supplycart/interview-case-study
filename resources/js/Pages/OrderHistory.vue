<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    orders: Array,
});
</script>

<template>
    <Head title="Shopping Cart" />

    <AuthenticatedLayout title="Order History">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Order History
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div v-if="orders.length === 0" class="text-center text-gray-500">
                        No orders found.
                    </div>
                    <div v-else v-for="order in orders" :key="order.id" class="mb-8 border-b pb-4">
                        <h3 class="text-lg font-semibold mb-2">Order #{{ order.id }}</h3>
                        <p class="text-sm text-gray-600 mb-2">Date: {{ new Date(order.created_at).toLocaleString() }}</p>
                        <p class="text-sm text-gray-600 mb-2">Status: {{ order.status }}</p>
                        <table class="w-full text-sm">
                            <thead>
                                <tr>
                                    <th class="text-left">Product</th>
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in order.order_items" :key="item.id">
                                    <td>{{ item.product.name }}</td>
                                    <td class="text-right">{{ item.quantity }}</td>
                                    <td class="text-right">${{ (item.price * item.quantity).toFixed(2) }}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-right font-semibold">Subtotal:</td>
                                    <td class="text-right">${{ order.sub_total.toFixed(2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-right font-semibold">Tax (8%):</td>
                                    <td class="text-right">${{ order.tax.toFixed(2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-right font-semibold">Total:</td>
                                    <td class="text-right">${{ order.total.toFixed(2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
