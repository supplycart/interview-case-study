<template>
  <teleport to="#navbar">
    <navbar />
  </teleport>

  <teleport to="#breadcrumbs">
    <nav class="flex" aria-label="Breadcrumb">
      <ol class="flex items-center space-x-4">
        <li>
          <div>
            <a href="#" class="text-gray-400 hover:text-gray-500">
              <HomeIcon class="flex-shrink-0 h-5 w-5" aria-hidden="true" />
              <span class="sr-only">Home</span>
            </a>
          </div>
        </li>
        <li>
          <div class="flex items-center">
            <ChevronRightIcon
              class="flex-shrink-0 h-5 w-5 text-gray-400"
              aria-hidden="true"
            />
            <router-link
              to="/my-orders"
              class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
              :aria-current="undefined"
              >My Orders</router-link
            >
          </div>
        </li>

        <li>
          <div class="flex items-center">
            <ChevronRightIcon
              class="flex-shrink-0 h-5 w-5 text-gray-400"
              aria-hidden="true"
            />
            <p
              v-if="order"
              class="ml-4 text-sm font-medium text-gray-500"
              :aria-current="'page'"
            >
              ORDER{{ order.id.toString().padStart(4, '0') }}
            </p>
          </div>
        </li>
      </ol>
    </nav>
  </teleport>

  <div class="px-4 py-6 sm:px-6">
    <div
      class="
        rounded-2xl
        p-12
        flex flex-col
        bg-gradient-to-r
        from-purple-800
        to-indigo-700
        h-full
      "
    >
      <div class="flex-1 px-12 py-8 rounded-2xl bg-indigo-900">
        <h2 class="text-2xl text-white font-semibold">Order Summary</h2>

        <div class="mt-10 h-40 overflow-y-auto">
          <ul v-if="order?.products" class="space-y-10">
            <li v-for="product in order.products" :key="product.id">
              <div class="py-4 flex items-start">
                <div class="w-20">
                  <div class="rounded-lg aspect-w-1 aspect-h-1">
                    <img
                      class="object-cover shadow-lg rounded-lg"
                      :src="product.productImage"
                    />
                  </div>
                </div>

                <div class="ml-6 flex-1 flex items-start justify-between">
                  <div class="flex-1">
                    <p class="text-white font-medium">
                      {{ product.productTitle }}
                    </p>

                    <p class="mt-1 text-gray-400">
                      {{ product.quantity }} x
                      {{ formatCurrency(product.productPrice) }}
                    </p>
                  </div>

                  <div>
                    <p class="text-white font-medium">
                      {{ formatCurrency(product.totalPrice) }}
                    </p>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>

      <div
        class="
          px-12
          py-8
          mt-5
          h-40
          bg-indigo-900
          rounded-2xl
          flex
          items-center
          justify-between
        "
      >
        <h2 class="text-2xl text-white font-semibold">Total</h2>
        <p class="text-white font-medium">{{ formatCurrency(order?.price) }}</p>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, ref } from 'vue'
import Navbar from '@/components/Navbar.vue'
import axios from '@/plugins/axios'
import { ChevronRightIcon, HomeIcon } from '@heroicons/vue/solid'

export default defineComponent({
  props: {
    id: String,
  },
  components: {
    Navbar,
    ChevronRightIcon,
    HomeIcon,
  },
  setup(props) {
    const order = ref(null)

    const getOrder = () => {
      axios.get(`/checkout/${props.id}`).then(({ data }) => {
        order.value = data.data
      })
    }

    const formatCurrency = (value: number) => {
      const formatter = new Intl.NumberFormat('ms-MY', {
        style: 'currency',
        currency: 'MYR',
        minimumFractionDigits: 2,
      })

      return formatter.format(value / 100)
    }

    onMounted(getOrder)

    return { order, formatCurrency }
  },
})
</script>
