<template>
    <Head :title="'Order Details'"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Order Details
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-[100rem] sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mt-2 border-b border-gray-200 pb-5 sm:flex justify-between md:justify-start gap-x-10">
                            <h1>Order number:&nbsp;<span class="font-bold">{{ order.order_number }}</span></h1>
                            <h2><time>{{ formatDateOnly(order.created_at) }}</time></h2>
                        </div>

                        <div class="bg-white mx-auto max-w-full px-4">
                            <div class="py-5">
                                <OrderStatus :current-order-status="currentOrderStatus" />
                            </div>
                            <div class="py-5">
                                <div v-for="product in products" :key="product.id" class="grid grid-cols-1 text-sm sm:grid-cols-12 sm:grid-rows-1 sm:gap-x-6 md:gap-x-8 lg:gap-x-8">
                                    <OrderImage :product-slug="product.slug" :image-url="product.image.url" />
                                    <OrderDescription :product="product" />
                                </div>
                            </div>
                            <div class="py-5">
                                <OrderBilling :order="order" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import {formatDateOnly, formatDateToIso} from "@/dateFormatter.js";
import OrderImage from "@/Pages/Order/Partials/OrderImage.vue";
import OrderStatus from "@/Pages/Order/Partials/OrderStatus.vue";
import OrderDescription from "@/Pages/Order/Partials/OrderDescription.vue";
import {computed} from "vue";
import OrderBilling from "@/Pages/Order/Partials/OrderBilling.vue";

const props = defineProps({
    order: Object
});

const orderItems = computed(() => {
    return props.order.items;
})

const products = computed(() => {
    return orderItems.value.map(item => {
        const product = item.product;
        product.quantity = item.quantity;
        product.original_price = item.original_price;
        product.discount = item.discount;
        product.total_price = item.total_price;

        return product;
    });
})

const address = computed(() => {
    return props.order.address;
})

const currentOrderStatus = computed(() => {
    if (props.order.status.value === 'pending') {
        return {
            copy: 'Order placed',
            date: formatDateToIso(props.order.created_at),
            step: 0
        };
    }

    if (props.order.status.value === 'processing') {
        return {
            copy: 'Processing',
            date: formatDateToIso(props.order.updated_at),
            step: 1
        };
    }

    if (props.order.status.value === 'completed') {
        return {
            copy: 'Completed',
            date: formatDateToIso(props.order.updated_at),
            step: 2
        };
    }
})
</script>
