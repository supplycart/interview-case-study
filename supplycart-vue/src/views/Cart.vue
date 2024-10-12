<script setup>
import { onMounted, ref, watch } from 'vue';
import { useCartStore } from '@/stores/useCart'; 
import ProductCard from '@/components/ProductCard.vue'; 
import axios from '@/utils/axios';

const loading = ref(true);  // Track loading state
const cartStore = useCartStore();
const selectedItems = ref([]);  // Track selected items for checkout

onMounted(async () => {
  await cartStore.fetchCartItems(); // Fetch cart items from the backend
  loading.value = false; // Set loading to false after data is fetched
});

// Watch for changes in selected items and refetch the total price
watch(
  selectedItems, 
  async (newSelectedItems) => {
    // Send the selected item IDs to the backend to get the updated total price
    const selectedItemIds = newSelectedItems.map(item => item.product_id);
    await cartStore.fetchCartItems(selectedItemIds); // Fetch cart items with selected items
  }
);

// Handle checkbox selection for checkout
const handleCheckboxChange = (item) => {
  const foundIndex = selectedItems.value.findIndex(selected => selected.product_id === item.product_id);
  if (foundIndex === -1) {
    selectedItems.value = [...selectedItems.value, { ...item }];
  } else {
    selectedItems.value = selectedItems.value.filter(selected => selected.product_id !== item.product_id);
  }
};

// Handle quantity update
const updateQuantity = async (item, change) => {
  // Update the quantity or remove the item if quantity reaches zero
  await cartStore.addToCart(item.product_id, change);

  // Refetch the cart items with the selected item IDs to get the updated total price
  const selectedItemIds = selectedItems.value.map(selectedItem => selectedItem.product_id);
  await cartStore.fetchCartItems(selectedItemIds);
};

// Proceed to checkout with selected items
const proceedToCheckout = async () => {
  if (selectedItems.value.length > 0) {
    try {
      const response = await axios.post('/api/orders', { items: selectedItems.value });
      alert('Order placed successfully! Order ID: ' + response.data.order_id);
      
      // Refetch cart data to update the cart (after items have been removed)
      await cartStore.fetchCartItems();

      selectedItems.value = [];
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
        Total: RM {{ cartStore.totalPrice }}
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
