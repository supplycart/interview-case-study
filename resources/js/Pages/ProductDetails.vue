<script setup>
import { ref } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
});

const product = ref(props.product);

const form = useForm({
    product_id: product.value.id,
    quantity: 1,
});

const addToCart = () => {
    form.post(route('cart.add'), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            // You can add a success message or any other logic here
            console.log('Product added to cart successfully');
        },
    });
};
</script>

<template>
    <Head :title="product.name" />

    <AuthenticatedLayout>
        <template #header>
            <div class="bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                        Product Details
                    </h2>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-100">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-1/2">
                                <img :src="product.image" :alt="product.name" class="w-full h-auto object-cover rounded-lg" />
                            </div>
                            <div class="md:w-1/2 md:pl-8 mt-4 md:mt-0">
                                <h1 class="text-3xl font-bold mb-4">{{ product.name }}</h1>
                                <p class="text-xl text-indigo-400 font-bold mb-4">${{ product.price.toFixed(2) }}</p>
                                <p class="text-gray-400 mb-4">Category: {{ product.category }}</p>
                                <p class="text-gray-400 mb-4">Brand: {{ product.brand }}</p>
                                <p class="text-gray-300 mb-8">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                </p>
                                <button
                                    @click="addToCart"
                                    class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300"
                                    :disabled="form.processing"
                                >
                                    {{ form.processing ? 'Adding...' : 'Add to Cart' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
