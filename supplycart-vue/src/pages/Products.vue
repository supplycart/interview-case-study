<script setup lang="ts">
import { ref, onMounted, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useUsers } from '@/stores/user'; // Store for user authentication
import api from '@/utils/api';

// Store products from backend
const products = ref([]);
const store = useUsers(); // User store
const router = useRouter();

// Computed property to check if the user is authenticated
const isAuthenticated = computed(() => store.authUser);

// Fetch products from the backend
const fetchProducts = async () => {
  try {
    const response = await api.get('/products'); 
    products.value = response.data;
  } catch (error) {
    console.error('Error fetching products:', error);
  }
};

// Add product to cart or redirect to login if not authenticated
const addToCart = (productId: number) => {
  if (isAuthenticated.value) {
    // Add the product to the cart (you would need to implement this logic)
    console.log(`Product ${productId} added to cart`);
  } else {
    // Redirect to login page if not authenticated
    router.push({ name: 'login' });
  }
};

// Fetch products when the component is mounted
onMounted(fetchProducts);
</script>

<template>
  <AuthenticatedLayout>
    <div class="container mx-auto px-4 py-6">
      <!-- Display products as cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <div
          v-for="product in products"
          :key="product.id"
          class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-200"
        >
          <img :src="product.image_url" alt="Product Image" class="w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-700">{{ product.name }}</h3>
            <p class="text-gray-600 mt-2">{{ product.description }}</p>
            <p class="text-lg font-bold text-gray-900 mt-4">RM {{ product.price }}</p>
            <button 
              @click="addToCart(product.id)"
              class="w-full mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg"
            >
              Add to Cart
            </button>
          </div>
        </div>
      </div>

      <!-- If there are no products, display a message -->
      <div v-if="products.length === 0" class="text-center text-gray-600 mt-8">
        No products available.
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.container {
  max-width: 1200px;
}
</style>
