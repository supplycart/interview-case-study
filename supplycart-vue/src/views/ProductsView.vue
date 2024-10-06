<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useCartStore } from '../stores/cartStore';
import type { Product } from '@/utils/types';
import api from '@/utils/api';

const products = ref<Product[]>([]);
const cartStore = useCartStore();

// Fetch products from the API
const fetchProducts = async () => {
  try {
    const response = await api.get('/products'); // Fetch products from backend
    products.value = response.data;
  } catch (error) {
    console.error('Error fetching products:', error);
  }
};

// Add product to cart
const addToCart = (product: Product) => {
  cartStore.addProductToCart(product);
};

// Fetch products when component is mounted
onMounted(fetchProducts);
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
