<template>
    <div class="cart-item flex items-center justify-between p-4 bg-white shadow rounded-lg space-x-4">
      <div class="flex-grow">
        <h3 class="text-lg font-semibold text-gray-800">{{ item.product.name }}</h3>
        <p class="text-sm text-gray-500">Price: {{ item.product.formatted_price }}</p>
      </div>
      <div class="flex items-center space-x-2">
        <label :for="`quantity-${item.product.id}`" class="sr-only">Quantity</label>
        <AppInput
          :id="`quantity-${item.product.id}`"
          type="number"
          :modelValue="item.quantity"
          @update:modelValue="updateQty($event)"
          min="1"
          :max="item.product.stock_quantity"
          class="w-20 text-center"
          :error="quantityError"
        />
      </div>
      <p class="text-md font-semibold text-gray-700 w-24 text-right">
        {{ formatCurrency(item.product.price_in_cents * item.quantity) }}
      </p>
      <AppButton variant="danger" @click="removeItemFromCart" customClass="p-2">
        🗑️
      </AppButton>
    </div>
  </template>
  
  <script>
  import { mapActions } from 'pinia';
  import { useCartStore } from '@/stores/cartStore';
  import AppInput from '@/components/UI/AppInput.vue';
  import AppButton from '@/components/UI/AppButton.vue';
  import { debounce } from 'lodash-es';
  
  export default {
    name: 'CartItem',
    components: { AppInput, AppButton },
    props: {
      item: {
        type: Object,
        required: true,
      },
    },
    data() {
      return {
        quantityError: '',
      }
    },
    methods: {
      ...mapActions(useCartStore, ['updateQuantity', 'removeItem']),
      updateQty(newQuantityStr) {
        const newQuantity = parseInt(newQuantityStr, 10);
        this.quantityError = '';
        if (isNaN(newQuantity) || newQuantity < 1) {
          // this.quantityError = "Min 1"; // Or handle silently by removing item via updateQuantity(0)
          this.cartStore.updateQuantity(this.item.product.id, 0); // Let store handle removal for 0 or less
          return;
        }
        if (newQuantity > this.item.product.stock_quantity) {
          // this.quantityError = `Max ${this.item.product.stock_quantity}`;
          this.cartStore.updateQuantity(this.item.product.id, this.item.product.stock_quantity); // Set to max
          return;
        }
        this.debouncedUpdateQuantity(this.item.product.id, newQuantity);
      },
      debouncedUpdateQuantity: debounce(function(productId, quantity) {
        this.cartStore.updateQuantity(productId, quantity);
      }, 500), // Debounce to avoid rapid API calls if store updates backend per change
      removeItemFromCart() {
        this.cartStore.removeItem(this.item.product.id);
      },
      formatCurrency(cents) {
        return '$' + (cents / 100).toFixed(2);
      }
    },
    computed: {
      cartStore() { // For easier access in methods if not using mapActions
        return useCartStore();
      }
    }
  };
  </script>
  