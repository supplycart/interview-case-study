<script setup>
import { onMounted, ref, watch } from 'vue';
import { useCartStore } from '@/stores/useCart'; 
import ProductCard from '@/components/ProductCard.vue'; // Import the ProductCard component
import axios from '@/utils/axios'; // Import axios for making API requests

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
  const index = selectedItems.value.findIndex(selected => selected.product_id === item.product_id);
  if (index === -1) {
    selectedItems.value.push({ ...item });
  } else {
    selectedItems.value.splice(index, 1);
  }
};

// Proceed to checkout with selected items
const proceedToCheckout = async () => {
  if (selectedItems.value.length > 0) {
    try {
      const response = await axios.post('/api/orders', { items: selectedItems.value });
      alert('Order placed successfully! Order ID: ' + response.data.order_id);
      
      // Refetch cart data to update the cart (after items have been removed)
      await cartStore.fetchCartItems();

      // Optionally, reset selectedItems array and redirect to an order confirmation page
      selectedItems.value = [];
      // router.push({ name: 'order-confirmation', params: { orderId: response.data.order_id } }); // Example of redirecting to order confirmation page
    } catch (error) {
      console.error('Error placing order:', error);
      alert('Failed to place order.');
    }
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

    <!-- Display cart items using ProductCard component -->
    <div v-else-if="cartStore.cartItems.length > 0" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <ProductCard
        v-for="item in cartStore.cartItems"
        :key="item.product_id"
        :product="item.product"
        :inCart="true"
        :quantity="item.quantity"
        :subtotal="item.subtotal"
        :showCheckbox="true"
        :checked="selectedItems.some(selected => selected.product_id === item.product_id)"
        :onCheckboxChange="() => handleCheckboxChange(item)"
        :updateQuantity="(change) => updateQuantity(item, change)"
      />
    </div>

    <!-- Display total price for selected items -->
    <div v-if="selectedItems.length > 0" class="mt-6">
      <h2 class="text-2xl font-bold text-gray-800">
        Total: RM {{ selectedItems.reduce((total, item) => total + (item.quantity * item.product.price), 0).toFixed(2) }}
      </h2>
      <button 
        @click="proceedToCheckout"
        class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg"
      >
        Place Order
      </button>
    </div>

    <!-- Message if no items are selected for checkout -->
    <div v-else class="text-center text-gray-600 mt-8">Please select items to place your order.</div>
  </div>
</template>

