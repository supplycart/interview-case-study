<script setup>
import PriceDisplay from '@/Components/PriceDisplay.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const { name, price, brandName, categoryName } = defineProps({
    id: Number,
    name: String,
    price: Number,
    brandName: String,
    categoryName: String,
});
</script>

<template>
    <Head title="Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="space-y-4">
                            <p class="text-lg">
                                <span class="font-semibold text-gray-700">
                                    Price:
                                </span>
                                <span class="font-bold text-green-600">
                                    <PriceDisplay :price="price" />
                                </span>
                            </p>
                            <p class="text-lg">
                                <span class="font-semibold text-gray-700">
                                    Brand:
                                </span>
                                {{ brandName }}
                            </p>
                            <p class="text-lg">
                                <span class="font-semibold text-gray-700">
                                    Category:
                                </span>
                                {{ categoryName }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
