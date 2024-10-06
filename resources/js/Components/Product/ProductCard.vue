<template>
    <div class="w-full max-w-full bg-white border border-gray-200 rounded-lg shadow p-2">
        <ProductImage :product-slug="product.slug" :image-url="product.images[0].url"></ProductImage>
        <div class="px-5 pb-5">
            <ProductAttribute :brand="brand" :categories="categories"></ProductAttribute>
            <Link
                :href="route('products.show', product)"
                v-html="product.name"
                class="text-xl font-semibold tracking-tight text-gray-900 overflow-ellipsis"
            />
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
import {computed} from "vue";
import ProductAttribute from "@/Pages/Product/Partial/ProductAttribute.vue";

const props = defineProps({
    product: Object
});

const categories = computed(() => {
    return props.product.categories;
});

const brand = computed(() => {
    return props.product.brand;
});
</script>
