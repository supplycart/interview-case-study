<template>
  <div
    class="
      flex
      justify-between
      items-center
      max-w-7xl
      mx-auto
      px-4
      py-6
      sm:px-6
      md:justify-start md:space-x-10
    "
  >
    <div class="flex justify-start lg:w-0 lg:flex-1">
      <router-link to="/">
        <span class="sr-only">Workflow</span>
        <img
          class="h-8 w-auto sm:h-10"
          src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
          alt=""
        />
      </router-link>
    </div>
    <PopoverGroup as="nav" class="hidden md:flex md:flex-1">
      <router-link
        v-if="loggedIn"
        to="/products"
        class="text-base font-medium text-gray-500 hover:text-gray-900"
      >
        Products
      </router-link>
    </PopoverGroup>

    <div
      v-if="!loggedIn"
      class="hidden md:flex items-center justify-end md:flex-1 lg:w-0"
    >
      <router-link
        to="/login"
        class="
          whitespace-nowrap
          text-base
          font-medium
          text-gray-500
          hover:text-gray-900
        "
      >
        Login
      </router-link>
      <router-link
        to="/register"
        class="
          ml-8
          whitespace-nowrap
          inline-flex
          items-center
          justify-center
          px-4
          py-2
          border border-transparent
          rounded-md
          shadow-sm
          text-base
          font-medium
          text-white
          bg-gradient-to-r
          from-purple-600
          to-indigo-600
          hover:from-purple-700 hover:to-indigo-700
        "
      >
        Register
      </router-link>
    </div>

    <div v-else class="flex items-center justify-between">
      <button
        type="button"
        class="text-gray-500 focus:outline-none focus:text-indigo-600 mr-8"
        @click="open = true"
      >
        <shopping-bag-icon class="w-6 h-6" />
      </button>

      <Menu
        as="div"
        class="
          hidden
          md:relative md:flex
          items-center
          justify-end
          md:flex-1
          lg:w-0
          ml-4
        "
      >
        <MenuButton
          class="text-gray-500 focus:outline-none focus:text-indigo-600"
        >
          <user-icon class="h-6 w-6" />
        </MenuButton>

        <transition
          enter-active-class="transition ease-out duration-100"
          enter-from-class="transform opacity-0 scale-95"
          enter-to-class="transform opacity-100 scale-100"
          leave-active-class="transition ease-in duration-75"
          leave-from-class="transform opacity-100 scale-100"
          leave-to-class="transform opacity-0 scale-95"
        >
          <MenuItems
            class="
              z-30
              absolute
              top-0
              right-0
              mt-8
              w-56
              rounded-md
              shadow-lg
              bg-white
              ring-1 ring-black ring-opacity-5
              divide-y divide-gray-100
              focus:outline-none
            "
          >
            <div class="py-1">
              <MenuItem v-slot="{ active }">
                <router-link
                  to="/my-orders"
                  :class="[
                    active ? 'bg-gray-100 text-gray-900' : 'text-gray-700',
                    'block px-4 py-2 text-sm',
                  ]"
                >
                  My Orders
                </router-link>
              </MenuItem>
            </div>
            <div class="py-1">
              <form @submit.prevent="logout">
                <MenuItem v-slot="{ active }">
                  <button
                    type="submit"
                    :class="[
                      active ? 'bg-gray-100 text-gray-900' : 'text-gray-700',
                      'block w-full text-left px-4 py-2 text-sm',
                    ]"
                  >
                    Sign out
                  </button>
                </MenuItem>
              </form>
            </div>
          </MenuItems>
        </transition>
      </Menu>
    </div>
  </div>

  <TransitionRoot as="template" :show="open">
    <Dialog
      as="div"
      static
      class="fixed inset-0 overflow-hidden"
      @close="open = false"
      :open="open"
    >
      <div class="absolute inset-0 overflow-hidden">
        <TransitionChild
          as="template"
          enter="ease-in-out duration-500"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="ease-in-out duration-500"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <DialogOverlay
            class="
              absolute
              inset-0
              bg-gray-500 bg-opacity-75
              transition-opacity
            "
          />
        </TransitionChild>

        <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
          <TransitionChild
            as="template"
            enter="transform transition ease-in-out duration-500 sm:duration-700"
            enter-from="translate-x-full"
            enter-to="translate-x-0"
            leave="transform transition ease-in-out duration-500 sm:duration-700"
            leave-from="translate-x-0"
            leave-to="translate-x-full"
          >
            <div class="w-screen max-w-md">
              <div
                class="
                  h-full
                  flex flex-col
                  py-6
                  bg-white
                  shadow-xl
                  overflow-y-scroll
                "
              >
                <div class="px-4 sm:px-6">
                  <div class="flex items-start justify-between">
                    <DialogTitle class="text-lg font-medium text-gray-900">
                      My Cart
                    </DialogTitle>
                    <div class="ml-3 h-7 flex items-center">
                      <button
                        class="
                          bg-white
                          rounded-md
                          text-gray-400
                          hover:text-gray-500
                          focus:outline-none
                          focus:ring-2
                          focus:ring-offset-2
                          focus:ring-indigo-500
                        "
                        @click="open = false"
                      >
                        <span class="sr-only">Close panel</span>
                        <XIcon class="h-6 w-6" aria-hidden="true" />
                      </button>
                    </div>
                  </div>
                </div>
                <div class="mt-6 relative flex-1 px-4 sm:px-6">
                  <ul class="grid grid-cols-1 grid-flow-row space-y-4">
                    <li v-for="product in cart" :key="product.productId">
                      <div
                        class="
                          flex
                          items-center
                          justify-between
                          p-4
                          rounded-md
                          bg-white
                          shadow-lg
                        "
                      >
                        <div class="w-24">
                          <div class="rounded-lg aspect-h-2">
                            <img
                              class="object-cover shadow-lg rounded-lg"
                              :src="product.productImage"
                            />
                          </div>
                        </div>

                        <div
                          class="flex-1 flex items-center justify-between ml-4"
                        >
                          <div class="flex-1 flex flex-col justify-between">
                            <p class="font-semibold">
                              {{ product.productTitle }} x
                              {{ product.quantity }}
                            </p>

                            <p
                              class="
                                font-semibold
                                text-transparent
                                bg-clip-text bg-gradient-to-r
                                text-purple-800
                                to-indigo-700
                              "
                            >
                              {{ formatCurrency(product.productPrice) }}
                            </p>
                          </div>

                          <div>
                            <button
                              type="button"
                              class="
                                p-2
                                bg-gradient-to-r
                                from-purple-800
                                to-indigo-700
                                text-white
                                rounded-md
                                shadow-md
                              "
                              @click.prevent="addCart(product.productId)"
                            >
                              <plus-icon class="w-4 h-4" />
                            </button>
                            <button
                              type="button"
                              class="mt-1 p-2 text-gray-500"
                              @click.prevent="removeCart(product.productId)"
                            >
                              <minus-icon class="w-4 h-4" />
                            </button>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>

                  <div
                    v-show="cart.length"
                    class="mt-4 flex items-center justify-end"
                  >
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
                      @click.prevent="checkout"
                    >
                      Checkout
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script lang="ts">
import { computed, defineComponent, ref } from 'vue'
import {
  Menu, //
  MenuButton,
  MenuItems,
  MenuItem,
  PopoverGroup,
  Dialog,
  DialogOverlay,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue'
import {
  UserIcon,
  XIcon,
  ShoppingBagIcon,
  PlusIcon,
  MinusIcon,
} from '@heroicons/vue/outline'
import { useStore } from '@/store'
import { AuthActionTypes } from '@/store/modules/auth/action-types'
import { CartActionTypes } from '@/store/modules/cart/action-types'
import { CheckoutActionTypes } from '@/store/modules/checkout/action-types'
import { useRouter } from 'vue-router'

export default defineComponent({
  components: {
    PopoverGroup,
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
    UserIcon,
    XIcon,
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    ShoppingBagIcon,
    PlusIcon,
    MinusIcon,
  },
  setup() {
    const open = ref(false)
    const store = useStore()
    const loggedIn = computed(() => store.getters.loggedIn)
    const cart = computed(() => store.getters.cart)
    const router = useRouter()

    const logout = () => {
      store.dispatch(AuthActionTypes.LOGOUT)
    }

    const formatCurrency = (value: number) => {
      const formatter = new Intl.NumberFormat('ms-MY', {
        style: 'currency',
        currency: 'MYR',
        minimumFractionDigits: 2,
      })

      return formatter.format(value / 100)
    }

    const addCart = (id: number) => {
      console.log({ productId: id, quantity: 1 })
      store.dispatch(CartActionTypes.ADD_CART, { productId: id, quantity: 1 })
    }

    const removeCart = (id: number) => {
      store.dispatch(CartActionTypes.REMOVE_CART, {
        productId: id,
        quantity: 1,
      })
    }

    const checkout = () => {
      store.dispatch(CheckoutActionTypes.CHECKOUT).then(() => {
        router.push('/checkout')
      })
    }

    return {
      open,
      loggedIn,
      cart,
      logout,
      formatCurrency,
      addCart,
      removeCart,
      checkout,
    }
  },
})
</script>
