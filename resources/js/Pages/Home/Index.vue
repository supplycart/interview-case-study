<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CardProduct from "@/Pages/Cart/Partials/CardProduct.vue";
import Pagination from "@/Components/Layouts/Pagination.vue";
import { Head } from '@inertiajs/vue3'

const props = defineProps({
    products: Object,
    carts_count: Number,
});
</script>

<template>
    <Head title="Home" />

    <AuthenticatedLayout :carts_count="carts_count">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home
            </h2>
        </template>

        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                Product List
            </h2>

            <div class="grid gap-4 grid-cols-4">
                <CardProduct
                    v-for="(product, id) in props.products.data"
                    v-bind:key="id"
                    :product="product"
                    @updateMessage="updateMessage"
                />
            </div>
        </div>

        <Pagination :links="props.products.links" />
    </AuthenticatedLayout>
</template>
