<script setup>
import { onMounted, ref, computed } from 'vue';
import axios from '@/utils/axios';
import OrderCard from '@/components/OrderCard.vue'; // Import order card component
import Loading from '@/components/Loading.vue'; // Import loading component
import Error from '@/components/Error.vue'; // Import error component

const orders = ref([]);
const loading = ref(true);
const error = ref(null);
const activeStatus = ref('To Pay');
const statuses = ['To Pay', 'To Ship', 'To Receive', 'Completed', 'Cancelled', 'Return Refund'];

// Fetch all orders from the backend
const fetchOrderHistory = async () => {
  try {
    loading.value = true;
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

// Handle tab click to filter orders based on status
const handleStatusClick = (status) => {
  activeStatus.value = status;
};

// Computed property to filter orders based on selected status
const filteredOrders = computed(() => {
  return orders.value.filter(order => order.status === activeStatus.value);
});
</script>

<template>
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Order History</h1>

    <!-- Status Tabs -->
    <div class="flex justify-between mb-6 border-b">
      <button 
        v-for="status in statuses" 
        :key="status" 
        @click="handleStatusClick(status)"
        :class="['text-gray-600 px-4 py-2', activeStatus === status ? 'font-bold border-b-2 border-black' : '']"
      >
        {{ status }}
      </button>
    </div>

    <!-- Loading state -->
    <Loading v-if="loading" />

    <!-- Error state -->
    <Error v-if="error" :error="error" />

    <!-- Display orders -->
    <div v-if="filteredOrders.length > 0" class="space-y-4">
        <OrderCard 
            v-for="order in filteredOrders" 
            :key="order.id" 
            :order="order" 
        />
    </div>

    <!-- No orders -->
    <div v-if="!loading && filteredOrders.length === 0" class="text-center text-gray-600">
      You have no orders in this category yet.
    </div>
  </div>
</template>
