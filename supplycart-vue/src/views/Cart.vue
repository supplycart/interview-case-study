<script setup>
import { onMounted, ref, watch } from 'vue';
import { useCartStore } from '@/stores/useCart'; 

const loading = ref(true);  // Track loading state
const cartStore = useCartStore();
const selectedItems = ref([]);  // Track selected items for checkout

onMounted(async () => {
  await cartStore.fetchCartItems(); // Fetch cart items and total price from the backend
  loading.value = false; // Set loading to false after data is fetched
});

// Watch for changes in cartItems and log for debugging
watch(
  () => cartStore.cartItems, 
  (newCartItems) => {
    console.log('Cart items updated:', newCartItems);
  }
);

// Handle quantity update
const updateQuantity = (item, change) => {
  const newQuantity = item.quantity + change;
  if (newQuantity > 0) {
    cartStore.addToCart(item.product_id, change);
  }
};

// Handle checkbox selection for checkout
const handleCheckboxChange = (item) => {
  const index = selectedItems.value.indexOf(item.product_id);
  if (index === -1) {
    selectedItems.value.push(item.product_id);
  } else {
    selectedItems.value.splice(index, 1);
  }
};

// Proceed to checkout with selected items
const proceedToCheckout = () => {
  if (selectedItems.value.length > 0) {
    console.log('Proceeding to checkout with:', selectedItems.value);
    // Handle checkout logic here (e.g., redirect to checkout page)
  } else {
    alert('Please select items to proceed to checkout.');
  }
};
</script>

<template>
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Your Cart</h1>

    <!-- Display loading state -->
    <div v-if="loading" class="text-center text-gray-600">Loading cart...</div>

    <!-- Display cart items -->
    <div v-else-if="cartStore.cartItems.length > 0" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <div
        v-for="item in cartStore.cartItems"
        :key="item.product_id"
        class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-200 p-4"
      >
        <!-- Checkbox for selection -->
        <input 
          type="checkbox" 
          class="mb-4" 
          :checked="selectedItems.includes(item.product_id)"
          @change="handleCheckboxChange(item)" 
        />

        <!-- Product Image -->
        <img :src="item.product.image_url" alt="Product Image" class="w-full h-48 object-cover">
        
        <!-- Product Details -->
        <div class="p-4">
          <h3 class="text-lg font-semibold text-gray-700">{{ item.product.name }}</h3>
          <p class="text-gray-600 mt-2">{{ item.product.description }}</p>
          <p class="text-lg font-bold text-gray-900 mt-4">RM {{ item.product.price }}</p>
          
          <!-- Quantity row with - and + buttons -->
          <div class="flex items-center mt-4">
            <button 
              class="bg-gray-300 text-gray-900 px-2 py-1 rounded-lg"
              @click="updateQuantity(item, -1)"
            >
              -
            </button>
            <span class="mx-4">{{ item.quantity }}</span>
            <button 
              class="bg-gray-300 text-gray-900 px-2 py-1 rounded-lg"
              @click="updateQuantity(item, 1)"
            >
              +
            </button>
          </div>

          <p class="text-lg font-bold mt-4">Subtotal: RM {{ item.subtotal }}</p>

          <!-- <button 
            @click="cartStore.removeFromCart(item.product_id)"
            class="w-full mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg"
          >
            Remove
          </button> -->
        </div>
      </div>
    </div>

    <!-- Display total price from backend -->
    <div v-if="cartStore.cartItems.length > 0" class="mt-6">
      <h2 class="text-2xl font-bold text-gray-800">Total: RM {{ cartStore.totalPrice }}</h2>
      <button 
        @click="proceedToCheckout"
        class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg"
      >
        Proceed to Checkout
      </button>
    </div>

    <!-- Message if cart is empty -->
    <div v-else class="text-center text-gray-600 mt-8">Your cart is empty.</div>
  </div>
</template>

<style scoped>
.container {
  max-width: 1200px;
}
</style>
