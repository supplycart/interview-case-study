<script setup>
import { onMounted } from 'vue';
import { useProductsStore } from '@/stores/useProducts'; 
import { useCartStore } from '@/stores/useCart'; 

const productsStore = useProductsStore();
const cartStore = useCartStore();

// Fetch products when the component is mounted
onMounted(() => {
  productsStore.fetchProducts();
});

// Add a product to the cart
const handleAddToCart = (productId) => {
  cartStore.addToCart(productId)
    .then(() => {
      alert('Product added to cart successfully!');
    })
    .catch((error) => {
      console.error('Error adding product to cart:', error);
    });
};
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

    <!-- Products grid -->
    <div v-if="!productsStore.loading && !productsStore.error" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <div
        v-for="product in productsStore.products"
        :key="product.id"
        class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-200"
      >
        <img :src="product.image_url" alt="Product Image" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="text-lg font-semibold text-gray-700">{{ product.name }}</h3>
          <p class="text-gray-600 mt-2">{{ product.description }}</p>
          <p class="text-lg font-bold text-gray-900 mt-4">RM {{ product.price }}</p>
          <button
            @click="handleAddToCart(product.id)"
            class="w-full mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg"
          >
            Add to Cart
          </button>
        </div>
      </div>
    </div>

    <!-- If there are no products -->
    <div v-if="productsStore.products.length === 0 && !productsStore.loading" class="text-center text-gray-600">
      No products available.
    </div>
  </div>
</template>

<style scoped>
.container {
  max-width: 1200px;
}
</style>
