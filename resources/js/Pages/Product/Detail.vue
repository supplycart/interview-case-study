<script setup>
import { ref } from 'vue';
import PriceDisplay from '@/Components/PriceDisplay.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const { id, name, description, price, brandName, categoryName } = defineProps({
    id: Number,
    name: String,
    description: String,
    price: Number,
    brandName: String,
    categoryName: String,
});

const quantity = ref(1);

const addToCart = () => {
    console.log(`Added ${quantity.value} of Product ID ${id} to cart`);
    alert(`Added ${quantity.value} "${name}" to cart!`);

    // TODO: submit the form to add to cart
};
</script>

<template>
    <Head title="Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ name }}
            </h2>
            <p class="mt-2 text-lg text-gray-600">
                {{ description }}
            </p>

            <!-- Add to Cart Button & Quantity Selector -->
            <div class="mt-4 flex items-center space-x-8">
                <button
                    @click="addToCart"
                    class="rounded-md bg-indigo-600 px-6 py-3 text-white hover:bg-indigo-500"
                >
                    Add to Cart
                </button>

                <div class="flex items-center space-x-3">
                    <span class="font-semibold text-gray-700">Quantity:</span>
                    <button
                        @click="quantity > 1 ? quantity-- : null"
                        class="rounded-md bg-gray-300 px-3 py-2 text-lg hover:bg-gray-400"
                    >
                        −
                    </button>
                    <span class="text-lg font-bold">{{ quantity }}</span>
                    <button
                        @click="quantity++"
                        class="rounded-md bg-gray-300 px-3 py-2 text-lg hover:bg-gray-400"
                    >
                        +
                    </button>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="space-y-6">
                            <!-- Price -->
                            <p class="text-lg">
                                <span class="font-semibold text-gray-700">
                                    Price:
                                </span>
                                <PriceDisplay :price="price" />
                            </p>

                            <!-- Brand -->
                            <p class="text-lg">
                                <span class="font-semibold text-gray-700">
                                    Brand:
                                </span>
                                {{ brandName }}
                            </p>

                            <!-- Category -->
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
