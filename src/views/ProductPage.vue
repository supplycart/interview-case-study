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
            <router-link
              to="/products"
              class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
              >Products</router-link
            >
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
              aria-current="page"
              >{{ product.title }}</span
            >
          </div>
        </li>
      </ol>
    </nav>
  </teleport>

  <div class="px-4 py-6 sm:px-20">
    <div class="grid grid-cols-2 gap-x-10">
      <div class="col-span-1">
        <div class="rounded-lg aspect-w-4 aspect-h-4">
          <img class="object-cover shadow-lg rounded-lg" :src="product.image" />
        </div>
      </div>

      <div>
        <p class="text-5xl font-semibold text-gray-800">{{ product.title }}</p>

        <p
          class="
            mt-4
            text-3xl
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

        <p class="text-lg mt-12 text-gray-700 max-w-md">
          {{ product.description }}
        </p>

        <button
          type="button"
          class="
            px-5
            py-2
            mt-4
            rounded-md
            bg-gradient-to-r
            from-purple-800
            to-indigo-700
            text-white
          "
          @click="addCart(product.id)"
        >
          Add to Cart
        </button>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { useStore } from '@/store'
import { NotificationType, Product } from '@/types'
import { computed, defineComponent } from 'vue'
import { useRoute } from 'vue-router'
import Navbar from '@/components/Navbar.vue'
import { CartActionTypes } from '@/store/modules/cart/action-types'
import { NotificationActionTypes } from '@/store/modules/notification/action-types'
import { ChevronRightIcon, HomeIcon } from '@heroicons/vue/solid'

export default defineComponent({
  components: {
    Navbar,
    ChevronRightIcon,
    HomeIcon,
  },
  setup() {
    const store = useStore()
    const route = useRoute()
    const id = route.params.id[0]
    const product = computed(() =>
      store.getters.products.find(
        (data: Product) => data.id === parseInt(id, 10)
      )
    )

    const formatCurrency = (value: number) => {
      const formatter = new Intl.NumberFormat('ms-MY', {
        style: 'currency',
        currency: 'MYR',
        minimumFractionDigits: 2,
      })

      return formatter.format(value / 100)
    }

    const addCart = (productId: number) => {
      console.log({ productId, quantity: 1 })
      store
        .dispatch(CartActionTypes.ADD_CART, { productId, quantity: 1 })
        .then(() => {
          store.dispatch(NotificationActionTypes.NOTIFY, {
            title: 'Success',
            subtitle: 'Added product to the cart.',
            type: NotificationType.SUCCESS,
          })
        })
    }

    return { product, formatCurrency, addCart }
  },
})
</script>
