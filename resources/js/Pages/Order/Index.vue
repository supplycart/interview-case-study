<template>
    <Head title="Orders" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Orders
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-[100rem] sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <Table :headers="headers" :body="body" :show-action="true" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import Table from "@/Components/Table.vue";
import { computed } from "vue";
import { ucwords } from "@/stringFormatter.js";

const props = defineProps({
    orders: Object
});

const headers = [
    'Order Number',
    'Total Items',
    'Total Amount',
    'Payment Status',
    'Order Status',
    'Action'
]

const body = computed(() => {
    return props.orders.data.map(order => {
        return [
            order.order_number,
            order.items_count,
            order.currency + ' ' + order.total_payment,
            ucwords(order.payment_info.status.value),
            ucwords(order.status.value),
            route('order.show', order.order_number)
        ]
    })
})
</script>
