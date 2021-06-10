<template>
  <teleport to="#navbar">
    <navbar />
  </teleport>

  <teleport to="#breadcrumbs">
    <nav class="flex px-14" aria-label="Breadcrumb">
      <ol class="flex items-center space-x-4">
        <li>
          <div>
            <router-link to="/" class="text-gray-400 hover:text-gray-500">
              <HomeIcon class="flex-shrink-0 h-5 w-5" aria-hidden="true" />
              <span class="sr-only">Home</span>
            </router-link>
          </div>
        </li>
        <li>
          <div class="flex items-center">
            <ChevronRightIcon
              class="flex-shrink-0 h-5 w-5 text-gray-400"
              aria-hidden="true"
            />
            <span
              class="ml-4 text-sm font-medium text-gray-500"
              aria-current="span"
              >Products</span
            >
          </div>
        </li>
      </ol>
    </nav>
  </teleport>

  <div class="px-4 py-6 sm:px-20">
    <h1 class="text-4xl font-bold text-gray-800">Our Products</h1>

    <div class="mt-6">
      <ul class="grid grid-cols-4 gap-x-8 gap-y-12 h-96">
        <li v-for="product in products" :key="product.id">
          <router-link :to="`/products/${product.id}`">
            <div class="rounded-lg aspect-w-1 aspect-h-1">
              <img
                class="object-cover shadow-lg rounded-lg"
                :src="product.image"
              />
            </div>

            <p class="mt-4 text-lg font-medium">{{ product.title }}</p>
            <p
              class="
                mt-2
                text-xl
                font-semibold
                text-transparent
                bg-clip-text bg-gradient-to-r
                from-purple-800
                to-indigo-700
                hover:from-purple-700 hover:to-indigo-700
              "
            >
              {{ formatCurrency(product.price) }}
            </p>
          </router-link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent } from 'vue'
import { useStore } from '@/store'
import { ProductActionTypes } from '@/store/modules/products/action-types'
import Navbar from '@/components/Navbar.vue'
import { ChevronRightIcon, HomeIcon } from '@heroicons/vue/solid'

export default defineComponent({
  components: {
    Navbar,
    ChevronRightIcon,
    HomeIcon,
  },
  setup() {
    const store = useStore()
    store.dispatch(ProductActionTypes.GET_PRODUCTS)
    const products = computed(() => store.getters.products)

    const formatCurrency = (value: number) => {
      const formatter = new Intl.NumberFormat('ms-MY', {
        style: 'currency',
        currency: 'MYR',
        minimumFractionDigits: 2,
      })

      return formatter.format(value / 100)
    }

    return { products, formatCurrency }
  },
})
</script>
