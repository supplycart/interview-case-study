<template>
    <div class="w-full max-w-full bg-white border border-gray-200 rounded-lg shadow p-2">
        <ProductImage :product-slug="product.slug" :image-url="product.images[0].url"></ProductImage>
        <div class="px-5 pb-5">
            <div class="flex flex-grow overflow-auto justify-start gap-1 mb-3">
                <span
                    v-html="brand.name"
                    class="bg-indigo-400 text-indigo-50 text-xs font-semibold px-2.5 py-0.5 rounded-full"
                />
                <span
                    v-for="category in categories" v-html="category.name"
                    class="bg-indigo-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full"
                />
            </div>
            <Link
                :href="route('products.show', product)"
                class="text-xl font-semibold tracking-tight text-gray-900 overflow-ellipsis"
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
import {computed} from "vue";

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
