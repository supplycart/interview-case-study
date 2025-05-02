<script setup lang="ts">
import { useToastStore } from '@/stores/toast'
import { ref } from 'vue'
import { useCartStore } from '@/stores/cart'

const toast = useToastStore()

const props = defineProps<{
  product: {
    id: number
    name: string
    image_url: string
    brand?: { name: string }
    category?: { name: string }
  }
}>()

const quantity = ref(1)
const cart = useCartStore()

function addToCart() {
  if (quantity.value > 0) {
    cart.add(props.product.id, quantity.value)
    quantity.value = 1;
    toast.success('Added to cart');
  }
}
</script>

<template>
  <div class="p-4 rounded-xl border bg-white dark:bg-gray-900 shadow space-y-2">
    <img
      :src="product.image_url"
      alt="Product image"
      class="w-full h-40 object-cover rounded-md border"
    />
    <h3 class="text-lg font-bold truncate">{{ product.name }}</h3>
    <p class="text-sm text-gray-500">
      Brand: {{ product.brand?.name || 'N/A' }}
    </p>
    <p class="text-sm text-gray-500">
      Category: {{ product.category?.name || 'N/A' }}
    </p>

    <div class="flex items-center gap-2">
      <label class="text-sm">Qty:</label>
      <input
        v-model.number="quantity"
        type="number"
        min="1"
        class="input input-sm input-bordered w-20"
      />
    </div>

    <button @click="addToCart" class="btn btn-primary w-full mt-2">
      Add to Cart
    </button>
  </div>
</template>
