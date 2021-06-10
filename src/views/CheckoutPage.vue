<template>
  <div
    class="
      bg-gray-50
      grid grid-cols-2
      h-full
      justify-center
      py-12
      sm:px-6
      lg:px-8
    "
  >
    <div class="flex items-center justify-center">
      <router-link
        :to="'#'"
        class="
          flex
          items-center
          justify-between
          mt-4
          px-5
          py-2
          text-gray-500
          hover:text-gray-800
        "
        @click.prevent="back"
      >
        <arrow-narrow-left-icon class="w-5 h-5" />
        <span class="ml-2">Back</span>
      </router-link>

      <button
        type="button"
        class="
          ml-5
          px-5
          py-2
          mt-4
          rounded-md
          bg-gradient-to-r
          from-purple-800
          to-indigo-700
          text-white
        "
        @click="confirmCheckout"
      >
        Confirm Checkout
      </button>
    </div>

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
          <ul class="space-y-10">
            <li v-for="product in checkout.products" :key="product.id">
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
        <p class="text-white font-medium">
          {{ formatCurrency(checkout?.price) }}
        </p>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { useStore } from '@/store'
import { CheckoutActionTypes } from '@/store/modules/checkout/action-types'
import { NotificationActionTypes } from '@/store/modules/notification/action-types'
import { NotificationType } from '@/types'
import { computed, defineComponent } from 'vue'
import { useRouter } from 'vue-router'
import { ArrowNarrowLeftIcon } from '@heroicons/vue/outline'

export default defineComponent({
  components: {
    ArrowNarrowLeftIcon,
  },
  setup() {
    const store = useStore()
    const router = useRouter()
    const checkout = computed(() => store.getters.getCheckout)

    const formatCurrency = (value: number) => {
      const formatter = new Intl.NumberFormat('ms-MY', {
        style: 'currency',
        currency: 'MYR',
        minimumFractionDigits: 2,
      })

      return formatter.format(value / 100)
    }

    const confirmCheckout = () => {
      store
        .dispatch(CheckoutActionTypes.SUBMIT_CHECKOUT, {
          checkoutId: checkout.value.id,
        })
        .then(() => {
          router.push('/')
          store.dispatch(NotificationActionTypes.NOTIFY, {
            title: 'Success',
            subtitle: 'Your order have been placed successfully',
            type: NotificationType.SUCCESS,
          })
        })
        .catch((error) => {
          store.dispatch(NotificationActionTypes.NOTIFY, {
            title: error.response.statusText,
            subtitle: error.response.data.message,
            type: NotificationType.ERROR,
          })
        })
    }

    const back = () => {
      router.back()
    }

    return { checkout, formatCurrency, confirmCheckout, back }
  },
})
</script>
