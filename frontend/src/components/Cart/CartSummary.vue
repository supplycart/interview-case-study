<template>
    <div class="cart-summary bg-gray-50 p-6 rounded-lg shadow">
      <h3 class="text-xl font-semibold text-gray-800 mb-4">Order Summary</h3>
      <div class="space-y-2 mb-4">
        <div class="flex justify-between text-gray-600">
          <span>Subtotal ({{ cartStore.itemCount }} items)</span>
          <span>{{ cartStore.formattedTotalPrice }}</span>
        </div>
        <div class="flex justify-between text-gray-600">
          <span>Shipping</span>
          <span>Free</span> 
        </div>
      </div>
      <hr class="my-4">
      <div class="flex justify-between text-lg font-bold text-gray-800 mb-6">
        <span>Total</span>
        <span>{{ cartStore.formattedTotalPrice }}</span>
      </div>
      <AppButton 
        variant="success" 
        class="w-full" 
        @click="$emit('checkout')"
        :disabled="cartStore.itemCount === 0 || isProcessingOrder"
        :loading="isProcessingOrder"
      >
        Proceed to Checkout
      </AppButton>
    </div>
  </template>
  
  <script>
  import { mapStores } from 'pinia';
  import { useCartStore } from '@/stores/cartStore';
  import AppButton from '@/components/UI/AppButton.vue';
  
  export default {
    name: 'CartSummary',
    components: { AppButton },
    props: {
      isProcessingOrder: { // Passed from CartPage to show loading on button
        type: Boolean,
        default: false,
      }
    },
    emits: ['checkout'],
    computed: {
      ...mapStores(useCartStore), // Access as this.cartStore
    }
  };
  </script>
  