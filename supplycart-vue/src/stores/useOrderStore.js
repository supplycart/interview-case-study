import { ref } from 'vue';
import { defineStore } from 'pinia';
import axios from '@/utils/axios';

export const useOrderStore = defineStore('order', () => {
  const orders = ref([]);
  const loading = ref(false);
  const error = ref(null);

  // Fetch all orders from the backend
  const fetchOrderHistory = async () => {
    try {
      loading.value = true;
      error.value = null;
      const response = await axios.get('/api/orders');
      orders.value = response.data.orders;
    } catch (err) {
      console.error('Error fetching order history:', err);
      error.value = 'Failed to fetch order history.';
    } finally {
      loading.value = false;
    }
  };

  // Computed property to filter orders by status
  const filteredOrders = (activeStatus) => {
    return orders.value.filter(order => order.status === activeStatus);
  };

  return {
    orders,
    loading,
    error,
    fetchOrderHistory,
    filteredOrders,
  };
});
