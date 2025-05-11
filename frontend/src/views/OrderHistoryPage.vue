<template>
    <div class="order-history-page">
      <h1 class="text-3xl font-bold mb-8 text-gray-800">Your Order History</h1>
  
      <div v-if="orderStore.isOrderLoading" class="text-center py-10">
        <LoadingSpinner class="h-12 w-12 mx-auto text-blue-600" />
        <p class="mt-2 text-lg text-gray-600">Loading your orders...</p>
      </div>
  
      <AlertMessage
        v-else-if="orderStore.orderError"
        type="error"
        :message="orderStore.orderError"
        title="Could not load orders"
      />
  
      <div v-else-if="!orderStore.orderHistory || orderStore.orderHistory.length === 0" class="text-center bg-white p-8 rounded-lg shadow">
        <p class="text-xl text-gray-500">You haven't placed any orders yet.</p>
        <router-link to="/products" class="mt-4 inline-block">
          <AppButton variant="primary">Start Shopping</AppButton>
        </router-link>
      </div>
  
      <div v-else class="space-y-6">
        <OrderListItem v-for="order in orderStore.orderHistory" :key="order.id" :order="order" />
        
        <!-- Pagination -->
        <div v-if="orderStore.orderPagination && orderStore.orderPagination.totalPages > 1" class="mt-8 flex justify-center items-center space-x-2">
          <AppButton
            @click="changePage(orderStore.orderPagination.currentPage - 1)"
            :disabled="orderStore.orderPagination.currentPage === 1"
            variant="secondary"
          >
            Previous
          </AppButton>
          <span class="text-gray-700 px-2">
            Page {{ orderStore.orderPagination.currentPage }} of {{ orderStore.orderPagination.totalPages }}
          </span>
          <AppButton
            @click="changePage(orderStore.orderPagination.currentPage + 1)"
            :disabled="orderStore.orderPagination.currentPage === orderStore.orderPagination.totalPages"
            variant="secondary"
          >
            Next
          </AppButton>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { mapStores } from 'pinia';
  import { useOrderStore } from '@/stores/orderStore';
  import OrderListItem from '@/components/Orders/OrderListItem.vue';
  import LoadingSpinner from '@/components/UI/LoadingSpinner.vue';
  import AlertMessage from '@/components/UI/AlertMessage.vue';
  import AppButton from '@/components/UI/AppButton.vue';
  
  export default {
    name: 'OrderHistoryPage',
    components: { OrderListItem, LoadingSpinner, AlertMessage, AppButton },
    computed: {
      ...mapStores(useOrderStore), // Access as this.orderStore
    },
    methods: {
      fetchUserOrders(page = 1) {
        this.orderStore.fetchOrders(page);
      },
      changePage(page) {
        if (page > 0 && this.orderStore.orderPagination && page <= this.orderStore.orderPagination.totalPages) {
          this.fetchUserOrders(page);
        }
      }
    },
    created() {
      this.fetchUserOrders();
    }
  };
  </script>
  