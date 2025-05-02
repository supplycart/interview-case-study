<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, router } from '@inertiajs/vue3'
import type { BreadcrumbItem } from '@/types'
import { computed } from 'vue'
import { useCartStore } from '@/stores/cart'
import { useToastStore } from '@/stores/toast'

const cart = useCartStore()
const toast = useToastStore()

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Checkout',
    href: '/checkout',
  },
]

const total = computed(() =>
  cart.items.reduce((sum, item) => {
    const price = Number(item.product?.price ?? 0)
    return sum + price * item.quantity
  }, 0)
)

function confirmOrder() {
  if (!cart.items.length) {
    toast.error('Cart is empty.')
    return
  }

  router.post('/orders', { items: cart.items }, {
    onSuccess: () => {
      cart.clear()
      toast.success('Order placed successfully!')
      router.visit('/dashboard')
    },
    onError: () => {
      toast.error('Failed to place order.')
    }
  })
}
</script>

<template>
  <Head title="Checkout" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-6 max-w-3xl mx-auto space-y-6">
      <h1 class="text-2xl font-bold">🧾 Checkout</h1>

      <div v-if="!cart.items.length" class="text-gray-500 text-center">
        Cart is empty.
      </div>

      <div v-else class="space-y-4">
        <div
          v-for="item in cart.items"
          :key="item.product_id"
          class="flex justify-between border-b pb-2"
        >
          <div>
            <div class="font-semibold">{{ item.product?.name }}</div>
            <div class="text-sm text-gray-500">Qty: {{ item.quantity }}</div>
          </div>
          <div>
            RM {{
              item.product?.price
                ? (Number(item.product.price) * item.quantity).toFixed(2)
                : '0.00'
            }}
          </div>
        </div>

        <div class="flex justify-between border-t pt-4 font-semibold text-lg">
          <span>Total</span>
          <span>RM {{ total.toFixed(2) }}</span>
        </div>

        <button class="btn btn-primary w-full" @click="confirmOrder">
          Confirm & Place Order
        </button>
      </div>
    </div>
  </AppLayout>
</template>
