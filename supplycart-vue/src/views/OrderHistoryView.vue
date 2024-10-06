<script setup lang="ts">
import { useOrderStore } from '../stores/orderStore';
import type { Order } from '@/utils/types'; 

const orderStore = useOrderStore();
</script>

<template>
  <div>
    <h1 class="text-3xl font-bold mb-4">Order History</h1>
    <div v-if="orderStore.orders.value.length > 0"> 
      <ul>
        <li v-for="(order, index) in orderStore.orders.value" :key="index" class="border-b p-4 mb-4"> 
          <h2 class="font-bold">Order #{{ index + 1 }}</h2>
          <ul>
            <li v-for="item in order.items" :key="item.id">RM {{ item.name }} - {{ item.price }}</li>
          </ul>
        </li>
      </ul>
    </div>
    <p v-else class="text-gray-600">No orders placed yet.</p>
  </div>
</template>

<style scoped>
</style>
