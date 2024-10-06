<script setup lang="ts">
import { ref, onMounted } from 'vue';
import type { Order } from '@/utils/types';
import api from '@/utils/api';

const orders = ref<Order[]>([]);

// Fetch orders from the backend API
const fetchOrders = async () => {
  try {
    const response = await api.get('/orders'); // Fetch orders from backend
    orders.value = response.data;
  } catch (error) {
    console.error('Error fetching orders:', error);
  }
};

// Fetch orders on component mount
onMounted(fetchOrders);
</script>

<template>
  <div>
    <h1 class="text-3xl font-bold mb-4">Order History</h1>
    <div v-if="orders.length > 0">
      <ul>
        <li v-for="(order, index) in orders" :key="order.id" class="border-b p-4 mb-4">
          <h2 class="font-bold">Order #{{ index + 1 }}</h2>
          <ul>
            <!-- Access product details directly from each item in the order -->
            <li v-for="item in order.items" :key="item.id">{{ item.name }} - RM {{ item.price }} x {{ item.quantity }}</li>
          </ul>
        </li>
      </ul>
    </div>
    <p v-else class="text-gray-600">No orders placed yet.</p>
  </div>
</template>

<style scoped>
</style>
