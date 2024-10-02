<template>
    <div class="w-full md:w-1/2 px-4">
        <h2 class="text-3xl font-bold mb-2">{{ product.name }}</h2>
        <div class="mb-4">
            <span class="text-2xl font-bold mr-2">{{ product.currency }} {{ product.price }}</span>
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
</template>
<script setup lang="ts">
import AddToCart from "../../../Components/Cart/AddToCart.vue";
import {ref} from "vue";

defineProps({
    product: Object
})

const quantity = ref(1);
</script>
