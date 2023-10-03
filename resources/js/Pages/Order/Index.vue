<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CardOrder from "@/Pages/Order/Partials/CardOrder.vue"
import Pagination from "@/Components/Layouts/Pagination.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    orders: Object,
});
</script>

<template>
    <Head title="Orders" />

    <AuthenticatedLayout :carts_count="carts_count">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Orders
            </h2>
        </template>

        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                Order History
            </h2>

            <div v-if="props.orders.data.length > 0" class="grid gap-4 grid-cols-2">
                <div>
                    <CardOrder
                        v-for="(order, id) in props.orders.data"
                        v-bind:key="id"
                        class="mb-2"
                        :order="order"
                    />
                </div>
            </div>
            <div v-else class="p-4 w-full text-center">
                You don't have any purchases.
            </div>
        </div>

        <Pagination :links="props.orders.links" />
    </AuthenticatedLayout>
</template>
