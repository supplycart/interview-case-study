<template>
    <Head title="Products"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Products
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-3 justify-center overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div v-for="product in products">
                        <ProductCard :product="product" class="p-2"></ProductCard>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import ProductCard from "../../Components/ProductCard.vue";

defineProps({products: Array});
</script>
