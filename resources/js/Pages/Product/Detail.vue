<template>
    <Head :title="product.name"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ product.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="bg-white">
                        <div class="container mx-auto px-4 py-8">
                            <div class="flex flex-wrap -mx-4">
                                <!-- Product Images -->
                                <div class="w-full md:w-1/2 px-4 mb-8">
                                    <img :src="product.images[0].url" alt="Product"
                                         loading="lazy"
                                         class="w-full h-auto rounded-lg shadow-md mb-4" id="mainImage">
                                    <div class="flex gap-4 py-4 justify-center overflow-x-auto">
                                        <div v-for="(image, key) in product.images">
                                            <img :src="image.url" loading="lazy" :alt="'Thumbnail ' + key"
                                                 class="size-16 sm:size-20 object-cover rounded-md cursor-pointer opacity-60 hover:opacity-100 transition duration-300"
                                                 @click="changeImage(image)">
                                        </div>
                                    </div>
                                </div>

                                <!-- Product Details -->
                                <div class="w-full md:w-1/2 px-4">
                                    <h2 class="text-3xl font-bold mb-2">{{ product.name }}</h2>
                                    <div class="mb-4">
                                        <span class="text-2xl font-bold mr-2">{{ product.currency }}{{
                                                product.price
                                            }}</span>
                                    </div>
                                    <p class="text-gray-700 mb-6">{{ product.description }}</p>

                                    <div class="mb-6">
                                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity:</label>
                                        <input type="number" v-model="quantity" min="1"
                                               class="w-16 text-center rounded-md border-gray-300  shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    </div>

                                    <div class="flex space-x-4 mb-6">
                                        <AddToCart :product-id="product.id" :quantity="quantity"></AddToCart>
                                    </div>
                                </div>
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
import {Head} from "@inertiajs/vue3";
import AddToCart from "@/Components/Cart/AddToCart.vue";
import {ref} from "vue";

defineProps({
    product: Object
})

function changeImage(image) {
    document.getElementById('mainImage').src = image.url;
}

const quantity = ref(1);
</script>
