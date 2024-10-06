<script setup lang="ts">
import { useCartStore } from '../stores/cartStore';
import { useOrderStore } from '../stores/orderStore';
import type { CartItem } from '@/utils/types';
import api from '@/utils/api';

const cartStore = useCartStore();
const orderStore = useOrderStore();

// Function to place order via API
const placeOrder = async () => {
  const cartItems: CartItem[] = cartStore.cart.value;
  try {
    await api.post('/orders', {
      items: cartItems.map(item => ({
        product_id: item.id,
        quantity: 1, 
        price: item.price,
      })),
    });
    orderStore.placeOrder(cartItems); // Locally store the order
    cartStore.clearCart(); // Clear the cart
  } catch (error) {
    console.error('Error placing order:', error);
  }
};
</script>

<template>
  <div>
    <h1 class="text-3xl font-bold mb-4">Cart</h1>
    <div v-if="cartStore.cart.value.length > 0">
      <ul class="mb-4">
        <li v-for="item in cartStore.cart.value" :key="item.id" class="border-b p-2">
          {{ item.name }} - RM {{ item.price }}
        </li>
      </ul>
      <button @click="placeOrder" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
        Place Order
      </button>
    </div>
    <p v-else class="text-gray-600">Your cart is empty.</p>
  </div>
</template>

<style scoped>
</style>
