<template>
    <div
        class="w-fit max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 m-3 p-2">
        <a :href="route('products.show', product)">
            <img loading="lazy" class="p-8 rounded-t-lg" :src="product.image.url" alt="product image"/>
        </a>
        <div class="px-5 pb-5">
            <a :href="route('products.show', product)">
                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white mb-4">{{
                        product.name
                    }}</h5>
            </a>
            <div class="flex items-center justify-between">
                <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ product.currency }} {{
                        product.price
                    }}</span>
                <AddToCart :product-id="product.id"></AddToCart>
            </div>
        </div>
    </div>
</template>

<script setup>
import AddToCart from "@/Components/AddToCart.vue";

const props = defineProps({
    product: Object
});
</script>
