<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CardProduct from "@/Components/Cards/CardProduct.vue";
import PaymentPanel from "@/Pages/Cart/Partials/PaymentPanel.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    products: Object,
    carts_count: Number,
    total_price: Number,
});
</script>

<template>
    <Head title="My Cart" />

    <AuthenticatedLayout :carts_count="carts_count">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Cart
            </h2>
        </template>

        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                My Cart
            </h2>

            <div v-if="props.total_price > 0" class="grid gap-4 grid-cols-2">
                <div>
                    <CardProduct
                        v-for="(product, id) in props.products"
                        v-bind:key="id"
                        class="mb-2"
                        :product="product"
                        :hideAddToCart="true"
                    />
                </div>
                <div>
                    <PaymentPanel :total_price="props.total_price" />
                </div>
            </div>
            <div v-else class="p-4 w-full text-center">
                No item in your cart.
            </div>
        </div>
    </AuthenticatedLayout>
</template>
