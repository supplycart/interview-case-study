<script setup lang="ts">
import { useCartStore } from '@/stores/cart'
import { computed } from 'vue'

const cart = useCartStore()

const totalItems = computed(() => cart.totalItems())
</script>

<template>
    <div class="relative w-full">
        <button class="relative w-full btn btn-sm btn-ghost justify-start">
        🛒 Cart
        <span v-if="totalItems > 0" class="badge badge-sm absolute top-0 right-0">
            {{ totalItems }}
        </span>
        </button>

        <div
        v-if="cart.items.length"
        class="absolute left-full top-0 mt-2 ml-2 w-64 p-3 rounded-lg bg-white dark:bg-gray-900 border shadow-lg z-50"
        >
        <div v-for="item in cart.items" :key="item.product_id" class="flex justify-between items-center mb-2">
            <span>Product #{{ item.product_id }}</span>
            <span>x{{ item.quantity }}</span>
        </div>
        <button class="btn btn-sm btn-primary w-full mt-2" @click="$inertia.visit('/checkout')">
            Checkout
        </button>
        </div>
    </div>
</template>
  
