<template>
  <div
      class="rounded overflow-hidden shadow-lg \">
      <img class="h-1/2 mx-auto" :src="product.product_image" alt="CPU">
      <div class="px-6 py-4">
          <div class="font-bold text-xl mb-2">{{ product.product_name }}</div>
          <p class="text-gray-700 text-base pb-4">
            {{ product.product_description }}
          </p>
          <p class="text-gray-700 text-xl">
            RM{{ product.product_price }}
          </p>
      </div>
      <div class="flex flex-row justify-center items-center pb-4">
          <button class="px-6 py-2 transition ease-in duration-200 uppercase rounded-full hover:bg-gray-800 hover:text-white border-2 border-gray-900 focus:outline-none">Add to cart</button>
      </div>
  </div>
</template>

<script setup>
const { product } = defineProps({
  product: Object,
});
</script>

<style></style>