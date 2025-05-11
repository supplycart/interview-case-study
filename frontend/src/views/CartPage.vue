<template>
    <div class="cart-page">
      <h1 class="text-3xl font-bold mb-6 text-gray-800">Your Shopping Cart</h1>
      <div v-if="isCartLoading" class="text-center py-10">
        <p class="text-xl text-gray-600">Updating cart...</p>
      </div>
      <div v-else-if="cartItems.length === 0" class="text-center bg-white p-8 rounded-lg shadow">
        <p class="text-xl text-gray-500">Your cart is empty.</p>
        <router-link to="/products" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Continue Shopping
        </router-link>
      </div>
      <div v-else class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-4">
          <CartItem v-for="item in cartItems" :key="item.product.id" :item="item" />
        </div>
        <div class="lg:col-span-1">
          <CartSummary @checkout="handleCheckout" :is-processing-order="isProcessingOrder" />
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { mapState, mapActions } from 'pinia';
  import { useCartStore } from '@/stores/cartStore';
  import CartItem from '@/components/Cart/CartItem.vue';
  import CartSummary from '@/components/Cart/CartSummary.vue';
  import { useToast } from 'vue-toastification';
  
  export default {
    name: 'CartPage',
    components: {
      CartItem,
      CartSummary,
    },
    data() {
      return {
        isProcessingOrder: false // Local state for checkout button
      };
    },
    computed: {
      ...mapState(useCartStore, ['cartItems', 'isCartLoading']),
    },
    methods: {
      ...mapActions(useCartStore, ['placeOrder']),
      async handleCheckout() {
        this.isProcessingOrder = true;
        const toast = useToast(); // Get toast instance
        try {
          const order = await this.placeOrder();
          if (order) {
            // Order placed successfully, cartStore clears cart.
            // Navigate to order confirmation or order history
            this.$router.push({ name: 'OrderHistory' }); // Or a specific order confirmation page
          }
        } catch (error) {
          // Error already handled and toasted by cartStore, but can add component specific logic here if needed.
          console.error("Checkout failed in component:", error);
        } finally {
          this.isProcessingOrder = false;
        }
      }
    }
  };
  </script>
  