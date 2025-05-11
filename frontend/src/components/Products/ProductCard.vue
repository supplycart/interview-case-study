<template>
    <div class="product-card bg-white shadow-lg rounded-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
      <div class="p-4">
        <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ product.name }}</h3>
        <p class="text-gray-600 text-sm mb-3 h-12 overflow-hidden">{{ product.description?.substring(0, 80) + (product.description?.length > 80 ? '...' : '') }}</p>
        <div class="flex items-center justify-between mb-3">
          <p class="text-lg font-bold text-blue-600">{{ product.formatted_price }}</p>
          <span :class="stockPillClass" class="text-xs font-semibold px-2 py-1 rounded-full">
            {{ product.stock_quantity > 0 ? (product.stock_quantity < 10 ? `Low Stock (${product.stock_quantity})` : 'In Stock') : 'Out of Stock' }}
          </span>
        </div>
        <button
          @click="addToCartHandler"
          :disabled="product.stock_quantity === 0 || isAddingToCart"
          class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed"
        >
          {{ isAddingToCart ? 'Adding...' : (product.stock_quantity === 0 ? 'Out of Stock' : 'Add to Cart') }}
        </button>
      </div>
    </div>
  </template>
  
  <script>
  import { mapActions } from 'pinia';
  import { useCartStore } from '@/stores/cartStore';
  
  export default {
    name: 'ProductCard',
    props: {
      product: {
        type: Object,
        required: true
      }
    },
    data() {
      return {
        isAddingToCart: false, // Local state for button feedback
      };
    },
    computed: {
      stockPillClass() {
        if (this.product.stock_quantity === 0) {
          return 'bg-red-200 text-red-800';
        } else if (this.product.stock_quantity < 10) {
          return 'bg-yellow-200 text-yellow-800';
        } else {
          return 'bg-green-200 text-green-800';
        }
      }
    },
    methods: {
      ...mapActions(useCartStore, ['addItem']),
      addToCartHandler() {
        if (this.product.stock_quantity > 0) {
          this.isAddingToCart = true;
          // Simulating async operation for feedback, remove setTimeout if not needed
          setTimeout(() => {
            this.addItem(this.product, 1); // Add 1 quantity by default
            this.isAddingToCart = false;
          }, 300);
        }
      }
    }
  };
  </script>
  