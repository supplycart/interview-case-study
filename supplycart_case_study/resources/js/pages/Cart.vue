<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'
import type { BreadcrumbItem } from '@/types'
import { computed } from 'vue'
import { useCartStore } from '@/stores/cart'
import { router } from '@inertiajs/vue3'

interface CartItem {
  product_id: number
  quantity: number
  product?: {
    name: string
    price: number
    image_url: string
  }
}

const cart = useCartStore()

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Cart',
    href: '/cart',
  },
]

const cartItems = computed<CartItem[]>(() => cart.items)

const total = computed(() =>
  cartItems.value.reduce((sum, item) => {
    const price = Number(item.product?.price ?? 0)
    return sum + price * item.quantity
  }, 0)
)

function removeItem(productId: number) {
  cart.remove(productId)
}

function increaseQty(productId: number) {
  cart.add(productId, 1)
}

function decreaseQty(productId: number) {
  const item = cart.items.find(i => i.product_id === productId)
  if (item) {
    if (item.quantity <= 1) {
      cart.remove(productId)
    } else {
      cart.add(productId, -1)
    }
  }
}

function goToCheckout() {
  router.visit('/checkout')
}

</script>

<template>
  <Head title="Cart" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-6 max-w-5xl mx-auto space-y-6">
      <h1 class="text-2xl font-bold">🛒 Your Cart</h1>

      <div v-if="cartItems.length === 0" class="text-gray-500 text-center">
        Your cart is empty.
      </div>

      <div v-else class="space-y-4">
        <div
          v-for="item in cartItems"
          :key="item.product_id"
          class="flex gap-4 items-center border p-4 rounded-xl bg-white dark:bg-gray-900 shadow-sm"
        >
          <img
            :src="item.product?.image_url ?  item.product.image_url : '/images/products/default.png'"
            alt="Product image"
            class="w-16 h-16 object-cover rounded border"
          />

          <div class="flex-1">
            <h2 class="font-semibold text-lg">
              {{ item.product?.name || 'Unknown product' }}
            </h2>
            <p class="text-sm text-gray-500">
              RM {{ item.product?.price ? Number(item.product.price).toFixed(2) : '0.00' }}
            </p>

            <!-- Quantity Changer -->
            <div class="flex items-center gap-2 mt-2">
              <button
                class="px-2 py-1 bg-gray-200 rounded text-sm"
                @click="decreaseQty(item.product_id)"
              >
                −
              </button>
              <span>{{ item.quantity }}</span>
              <button
                class="px-2 py-1 bg-gray-200 rounded text-sm"
                @click="increaseQty(item.product_id)"
              >
                ＋
              </button>
            </div>
          </div>

          <div class="flex flex-col items-end justify-between h-full">
            <div class="text-right font-semibold">
              RM
              {{
                item.product?.price
                  ? (Number(item.product.price) * item.quantity).toFixed(2)
                  : '0.00'
              }}
            </div>

            <button class="text-sm text-red-500 mt-2" @click="removeItem(item.product_id)">
              Remove
            </button>
          </div>
        </div>

        <div class="flex justify-between items-center border-t pt-4 text-lg font-semibold">
          <span>Total</span>
          <span>RM {{ total.toFixed(2) }}</span>
        </div>

        <button class="btn btn-primary w-full" @click="goToCheckout">
          Proceed to Checkout
        </button>
      </div>
    </div>
  </AppLayout>
</template>
