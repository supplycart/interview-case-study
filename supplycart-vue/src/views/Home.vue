<script setup>
import { onMounted } from 'vue';
import { useProductsStore } from '@/stores/useProducts'; 
import ProductCard from '@/components/ProductCard.vue'; // Import the new ProductCard component

const productsStore = useProductsStore();

// Fetch products when the component is mounted
onMounted(() => {
  productsStore.fetchProducts();
});
</script>

<template>
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Products</h1>

    <!-- Loading state -->
    <div v-if="productsStore.loading" class="text-center text-gray-600">
      Loading products...
    </div>

    <!-- Error state -->
    <div v-if="productsStore.error" class="text-center text-red-600">
      {{ productsStore.error }}
    </div>

    <!-- Products grid using ProductCard component -->
    <div v-if="!productsStore.loading && !productsStore.error" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <ProductCard
        v-for="product in productsStore.products"
        :key="product.id"
        :product="product"
      />
    </div>

    <!-- If there are no products -->
    <div v-if="productsStore.products.length === 0 && !productsStore.loading" class="text-center text-gray-600">
      No products available.
    </div>
  </div>
</template>

