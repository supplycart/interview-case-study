<script setup lang="ts">
import { ref } from 'vue';
import { useCartStore } from '../stores/cartStore';
import type { Product } from '@/utils/types'; 

// Define the list of products using the Product type
const products = ref<Product[]>([
  { id: 1, name: 'Product 1', price: 100 },
  { id: 2, name: 'Product 2', price: 150 },
  { id: 3, name: 'Product 3', price: 200 },
]);

const cartStore = useCartStore();

// Enforce Product type on the function parameter
const addToCart = (product: Product) => {
  cartStore.addProductToCart(product);
};
</script>

<template>
  <div>
    <h1 class="text-3xl font-bold mb-4">Products</h1>
    <div class="grid grid-cols-3 gap-4">
      <div v-for="product in products" :key="product.id" class="border p-4">
        <h2 class="text-xl font-bold">{{ product.name }}</h2>
        <p class="text-gray-700">RM {{ product.price }}</p>
        <button @click="addToCart(product)" class="bg-blue-500 text-white px-4 py-2 mt-4 rounded hover:bg-blue-700">
          Add to Cart
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped>
</style>
