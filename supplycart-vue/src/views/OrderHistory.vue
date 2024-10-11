<script setup>
import { onMounted, ref } from 'vue';
import axios from '@/utils/axios'; 

const orders = ref([]);
const loading = ref(true);
const error = ref(null);

// Fetch the user's order history from the backend
const fetchOrderHistory = async () => {
  try {
    const response = await axios.get('/api/orders'); 
    orders.value = response.data.orders; 
  } catch (err) {
    error.value = 'Failed to fetch order history.';
  } finally {
    loading.value = false;
  }
};

// Fetch orders on component mount
onMounted(() => {
  fetchOrderHistory();
});
</script>

<template>
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Order History</h1>

    <!-- Loading state -->
    <div v-if="loading" class="text-center text-gray-600">Loading order history...</div>

    <!-- Error state -->
    <div v-if="error" class="text-center text-red-600">{{ error }}</div>

    <!-- Display orders -->
    <div v-if="orders.length > 0" class="space-y-4">
      <div
        v-for="order in orders"
        :key="order.id"
        class="bg-white shadow-md p-4 rounded-lg"
      >
        <h2 class="text-xl font-bold text-gray-700">Order ID: {{ order.id }}</h2>
        <p class="text-gray-600">Total: RM {{ order.total_price }}</p>
        <p class="text-gray-500">Date: {{ new Date(order.date).toLocaleDateString() }}</p>
        <ul class="mt-2 space-y-2">
          <li
            v-for="item in order.items"
            :key="item.id"
            class="flex justify-between items-center"
          >
            <span>{{ item.product.name }} (x{{ item.quantity }})</span>
            <span>RM {{ item.price * item.quantity }}</span>
          </li>
        </ul>
      </div>
    </div>

    <!-- No orders -->
    <div v-if="!loading && orders.length === 0" class="text-center text-gray-600">
      You have no orders yet.
    </div>
  </div>
</template>
