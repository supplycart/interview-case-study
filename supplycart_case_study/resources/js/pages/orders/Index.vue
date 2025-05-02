<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import type { BreadcrumbItem } from '@/types'
import { computed } from 'vue'

interface OrderProduct {
  name: string
  qty: number
  price: number
  total: number
}

interface Order {
  id: number
  receipt_no: string
  total: number
  status: string
  created_at: string
  products: OrderProduct[]
}

const page = usePage()
const orders = computed(() => page.props.orders as Order[])

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Order History', href: '/orders' },
]
</script>

<template>
  <Head title="Order History" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="max-w-5xl mx-auto p-6 space-y-6">
      <h1 class="text-2xl font-bold">📦 Order History</h1>

      <div v-if="!orders.length" class="text-gray-500">
        You haven’t placed any orders yet.
      </div>

      <div v-for="order in orders" :key="order.id" class="border rounded-xl p-4 shadow-sm bg-white dark:bg-gray-900 space-y-4">
        <div class="flex justify-between items-center text-sm text-gray-600 dark:text-gray-300">
          <div>
            <span class="font-semibold">Receipt:</span> {{ order.receipt_no }}
          </div>
          <div>
            {{ order.created_at }}
          </div>
        </div>

        <div class="text-sm space-y-2">
          <div
            v-for="product in order.products"
            :key="product.name"
            class="flex justify-between"
          >
            <div>
              {{ product.name }} x {{ product.qty }}
            </div>
            <div>
              RM {{ Number(product.total).toFixed(2) }}
            </div>
          </div>
        </div>

        <div class="flex justify-between font-semibold pt-2 border-t">
          <span>Total</span>
          <span>RM {{ Number(order.total).toFixed(2) }}</span>
        </div>

        <div class="text-right text-xs text-gray-500">
          Status: {{ order.status }}
        </div>
      </div>
    </div>
  </AppLayout>
</template>
