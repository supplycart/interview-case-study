import { defineStore } from 'pinia';
import apiClient from '@/services/api';
import { useToast } from 'vue-toastification';

const toast = useToast();

export const useOrderStore = defineStore('order', {
  state: () => ({
    orders: [],
    currentOrder: null,
    pagination: {},
    isLoading: false,
    error: null,
  }),
  getters: {
    orderHistory: (state) => state.orders,
    orderDetails: (state) => state.currentOrder,
    orderPagination: (state) => state.pagination,
    isOrderLoading: (state) => state.isLoading,
    orderError: (state) => state.error,
  },
  actions: {
    async fetchOrders(page = 1, perPage = 10) {
      this.isLoading = true;
      this.error = null;
      try {
        const response = await apiClient.get('/orders', { params: { page, per_page: perPage } });
        this.orders = response.data.data;
        this.pagination = {
          currentPage: response.data.meta.current_page,
          totalPages: response.data.meta.last_page,
          totalItems: response.data.meta.total,
          perPage: response.data.meta.per_page,
        };
      } catch (err) {
        this.error = err.response?.data?.message || 'Failed to fetch order history.';
        toast.error(this.error);
        this.orders = [];
        this.pagination = {};
      } finally {
        this.isLoading = false;
      }
    },
    async fetchOrderById(orderId) {
      this.isLoading = true;
      this.error = null;
      this.currentOrder = null;
      try {
        const response = await apiClient.get(`/orders/${orderId}`);
        this.currentOrder = response.data.data;
      } catch (err) {
        this.error = err.response?.data?.message || `Failed to fetch order ${orderId}.`;
        toast.error(this.error);
      } finally {
        this.isLoading = false;
      }
    },
    clearCurrentOrder() {
        this.currentOrder = null;
    }
  },
});
