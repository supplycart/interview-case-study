<template>
    <div class="sm:col-span-4 md:col-span-5 md:row-span-2 md:row-end-2">
        <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg">
            <ProductImage :product-slug="productSlug" :image-url="imageUrl" class="object-cover object-center" />
        </div>
    </div>
</template>
<script setup>
import ProductImage from "@/Components/Product/ProductImage.vue";

defineProps({
    productSlug: String,
    imageUrl: String
});
</script>
