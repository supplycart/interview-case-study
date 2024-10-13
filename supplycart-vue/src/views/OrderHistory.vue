<script setup>
import { ref, computed, onMounted } from 'vue';
import { useOrderStore } from '@/stores/useOrderStore'; 
import OrderCard from '@/components/OrderCard.vue';
import Loading from '@/components/Loading.vue'; 
import Error from '@/components/Error.vue';
import StatusTabs from '@/components/StatusTabs.vue'; 

const orderStore = useOrderStore(); 
const activeStatus = ref('To Pay');
const statuses = ['To Pay', 'To Ship', 'To Receive', 'Completed', 'Cancelled', 'Return Refund'];

// Fetch orders on component mount
onMounted(() => {
  orderStore.fetchOrderHistory(); // Fetch order history using the store
});

// Computed property to filter orders based on selected status
const filteredOrders = computed(() => {
  return orderStore.filteredOrders(activeStatus.value);
});
</script>

<template>
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Order History</h1>

    <!-- Status Tabs -->
    <StatusTabs
      :statuses="statuses"
      :activeStatus="activeStatus"
      @update:activeStatus="activeStatus = $event"
    />

    <!-- Loading state -->
    <Loading v-if="orderStore.loading" />

    <!-- Error state -->
    <Error v-if="orderStore.error" :error="orderStore.error" />

    <!-- Display orders -->
    <div v-if="filteredOrders.length > 0" class="space-y-4">
      <OrderCard 
        v-for="order in filteredOrders" 
        :key="order.id" 
        :order="order" 
      />
    </div>

    <!-- No orders -->
    <div v-if="!orderStore.loading && filteredOrders.length === 0" class="text-center text-gray-600">
      You have no orders in this category yet.
    </div>
  </div>
</template>
