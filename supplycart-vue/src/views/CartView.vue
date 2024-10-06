<script setup lang="ts">
import { useCartStore } from '../stores/cartStore';
import { useOrderStore } from '../stores/orderStore';
import type { CartItem } from '@/utils/types';

const cartStore = useCartStore();
const orderStore = useOrderStore();

const placeOrder = () => {
  const cartItems: CartItem[] = cartStore.cart.value; // Ensure cart items are of type CartItem
  orderStore.placeOrder(cartItems);
  cartStore.clearCart();
};
</script>

<template>
  <div>
    <h1 class="text-3xl font-bold mb-4">Cart</h1>
    <div v-if="cartStore.cart.value.length > 0"> 
      <ul class="mb-4">
        <li v-for="item in cartStore.cart.value" :key="item.id" class="border-b p-2"> 
          {{ item.name }} - {{ item.price }}
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
