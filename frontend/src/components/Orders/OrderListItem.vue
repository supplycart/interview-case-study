<template>
    <div class="order-list-item bg-white p-4 shadow rounded-lg hover:shadow-md transition-shadow duration-200">
      <div class="flex justify-between items-center mb-3">
        <h3 class="text-lg font-semibold text-blue-600">Order #{{ order.order_number }}</h3>
        <span class="px-3 py-1 text-xs font-semibold rounded-full" :class="statusClass">
          {{ order.status.charAt(0).toUpperCase() + order.status.slice(1) }}
        </span>
      </div>
      <div class="text-sm text-gray-600 space-y-1">
        <p><strong>Date:</strong> {{ order.order_date }}</p>
        <p><strong>Total:</strong> {{ order.formatted_total_amount }}</p>
        <p><strong>Items:</strong> {{  itemCount }}</p>
      </div>
      <div class="mt-4">
        <!-- <AppButton variant="secondary" @click="viewOrderDetails" customClass="text-sm">
          View Details
        </AppButton> -->
        <!-- Could also be a router-link if you have a dedicated OrderDetailPage -->
         <ul v-if="order.items && order.items.length" class="mt-2 space-y-1 text-xs text-gray-500 pl-4 border-l-2 border-gray-200">
          <li v-for="item in order.items.slice(0, 3)" :key="item.id">
            {{item.quantity}} x {{ item.product_name || 'Product details unavailable' }}
          </li>
          <li v-if="order.items.length > 3">... and {{order.items.length - 3}} more item(s)</li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  // import AppButton from '@/components/UI/AppButton.vue';
  
  export default {
    name: 'OrderListItem',
    // components: { AppButton },
    props: {
      order: {
        type: Object,
        required: true,
      },
    },
    computed: {
      statusClass() {
        const statuses = {
          pending: 'bg-yellow-100 text-yellow-800',
          processing: 'bg-blue-100 text-blue-800',
          completed: 'bg-green-100 text-green-800',
          shipped: 'bg-indigo-100 text-indigo-800',
          cancelled: 'bg-red-100 text-red-800',
        };
        return statuses[this.order.status.toLowerCase()] || 'bg-gray-100 text-gray-800';
      },
      itemCount() {
          if (this.order.items && Array.isArray(this.order.items)) {
              return this.order.items.reduce((sum, item) => sum + item.quantity, 0);
          }
          return 0;
      }
    },
    methods: {
      // viewOrderDetails() {
      //   this.$router.push({ name: 'OrderDetail', params: { id: this.order.id } });
      // }
    }
  };
  </script>
  