<template>
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
</template>

<script setup>
defineProps({
    product: Object
})

function changeImage(image) {
    document.getElementById('mainImage').src = image.url;
}
</script>
