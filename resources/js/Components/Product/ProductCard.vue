<template>
    <div
        class="w-full max-w-full bg-white border border-gray-200 rounded-lg shadow p-2">
        <ProductImage :product-id="product.id" :image-url="product.images[0].url"></ProductImage>
        <div class="px-5 pb-5">
            <Link
                :href="route('products.show', product)"
                class="text-xl font-semibold tracking-tight text-gray-900"
            >
                {{ product.name }}
            </Link>
            <div class="flex items-start justify-start">
                <span class="text-lg font-bold text-gray-900 my-3">{{ product.currency }} {{ parseFloat(product.price).toFixed(2) }}</span>
            </div>
            <div class="flex items-center justify-center">
                <AddToCart :product-id="product.id"></AddToCart>
            </div>
        </div>
    </div>
</template>

<script setup>
import AddToCart from "@/Components/Cart/AddToCart.vue";
import ProductImage from "@/Components/Product/ProductImage.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    product: Object
});
</script>
