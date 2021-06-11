<template>
  <teleport to="#navbar">
    <navbar />
  </teleport>

  <div class="px-4 py-6 sm:px-6">
    <h1 class="text-4xl font-bold text-gray-800">My Orders</h1>

    <div class="flex flex-col mt-8">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div
            class="
              shadow
              overflow-hidden
              border-b border-gray-200
              sm:rounded-lg
            "
          >
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-100">
                <tr>
                  <th
                    scope="col"
                    class="
                      px-6
                      py-3
                      text-left text-xs
                      font-medium
                      text-gray-500
                      uppercase
                      tracking-wider
                    "
                  >
                    Order ID
                  </th>
                  <th
                    scope="col"
                    class="
                      px-6
                      py-3
                      text-left text-xs
                      font-medium
                      text-gray-500
                      uppercase
                      tracking-wider
                    "
                  >
                    Status
                  </th>
                  <th
                    scope="col"
                    class="
                      px-6
                      py-3
                      text-left text-xs
                      font-medium
                      text-gray-500
                      uppercase
                      tracking-wider
                    "
                  >
                    Total Price
                  </th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="order in orders" :key="order.id">
                  <td
                    class="
                      px-6
                      py-4
                      whitespace-nowrap
                      text-sm
                      font-medium
                      text-gray-900
                    "
                  >
                    ORDER{{ order.id.toString().padStart(4, '0') }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <span
                      v-if="order.status === 'pending'"
                      class="
                        inline-flex
                        items-center
                        px-2
                        py-0.5
                        rounded
                        text-xs
                        uppercase
                        font-medium
                        bg-yellow-100
                        text-yellow-800
                      "
                    >
                      {{ order.status }}
                    </span>
                    <span
                      v-else-if="order.status === 'completed'"
                      class="
                        inline-flex
                        items-center
                        px-2
                        py-0.5
                        rounded
                        text-xs
                        uppercase
                        font-medium
                        bg-green-100
                        text-green-800
                      "
                    >
                      {{ order.status }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ formatCurrency(order.price) }}
                  </td>
                  <td
                    class="
                      px-6
                      py-4
                      whitespace-nowrap
                      text-right text-sm
                      font-medium
                    "
                  >
                    <button
                      v-if="order.status === 'pending'"
                      type="button"
                      class="
                        mr-4
                        font-medium
                        text-transparent
                        bg-clip-text bg-gradient-to-r
                        from-purple-800
                        to-indigo-700
                        hover:from-purple-700 hover:to-indigo-700
                      "
                      @click="proceed(order.id)"
                    >
                      Proceed
                    </button>

                    <router-link
                      :to="`/my-orders/${order.id}`"
                      class="
                        text-transparent
                        bg-clip-text bg-gradient-to-r
                        from-purple-800
                        to-indigo-700
                        hover:from-purple-700 hover:to-indigo-700
                      "
                      >Show</router-link
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, ref } from 'vue'
import Navbar from '@/components/Navbar.vue'
import axios from '@/plugins/axios'
import { store } from '@/store'
import { CheckoutActionTypes } from '@/store/modules/checkout/action-types'
import { useRouter } from 'vue-router'

export default defineComponent({
  components: {
    Navbar,
  },
  setup() {
    const orders = ref([])
    const router = useRouter()
    const getOrderListing = () => {
      axios.get('/checkout').then(({ data }) => {
        orders.value = data.data
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

    const proceed = (checkoutId: number) => {
      store
        .dispatch(CheckoutActionTypes.GET_CHECKOUT, { checkoutId })
        .then(() => {
          router.push('/checkout')
        })
    }

    onMounted(getOrderListing)

    return { orders, formatCurrency, proceed }
  },
})
</script>

<style></style>
