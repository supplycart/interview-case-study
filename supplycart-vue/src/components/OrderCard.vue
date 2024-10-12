<template>
    <div class="bg-white shadow-md p-4 rounded-lg">
        <h2 class="text-xl font-bold text-gray-700">Order ID: {{ order.id }}</h2>
        <p class="text-gray-600">Total: RM {{ order.total_price }}</p>
        <p class="text-gray-500">Date: {{ new Date(order.date).toLocaleDateString() }}</p>
        <ul class="mt-2 space-y-2">
            <li v-for="item in order.items" :key="item.id" class="flex justify-between items-center">
            <span>{{ item.product.name }} (x{{ item.quantity }})</span>
            <span>RM {{ item.price * item.quantity }}</span>
            </li>
        </ul>
    </div>
</template>
  
<script setup>
  const props = defineProps({
    order: {
      type: Object,
      required: true,
    },
  });
</script>
  