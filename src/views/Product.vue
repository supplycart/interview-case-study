<template>
  <div class="min-h-screen bg-gray-50 pb-12 sm:px-6 lg:px-8">
    <div
      class="
        flex
        justify-between
        items-center
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
      <!-- <div class="-mr-2 -my-2 md:hidden">
        <PopoverButton
          class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
        >
          <span class="sr-only">Open menu</span>
          <MenuIcon class="h-6 w-6" aria-hidden="true" />
        </PopoverButton>
      </div> -->
      <PopoverGroup as="nav" class="hidden md:flex space-x-10">
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
            bg-indigo-600
            hover:bg-indigo-700
          "
        >
          Register
        </router-link>
      </div>
      <Menu
        v-else
        as="div"
        class="
          hidden
          md:relative md:flex
          items-center
          justify-end
          md:flex-1
          lg:w-0
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
              absolute
              top-0
              right-0
              mt-8
              w-56
              rounded-md
              shadow-lg
              bg-white
              ring-1 ring-black ring-opacity-5
              focus:outline-none
            "
          >
            <div>
              <form @submit.prevent="logout">
                <MenuItem v-slot="{ active }">
                  <button
                    type="submit"
                    :class="[
                      active
                        ? 'bg-indigo-600 text-white rounded-md'
                        : 'text-gray-700',
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

    <div class="px-4 py-6 sm:px-6">
      <h1 class="text-4xl font-bold text-gray-800">Our Products</h1>

      <div class="mt-6">
        <ul class="grid grid-cols-4 gap-x-8 gap-y-12 h-96">
          <li v-for="product in products" :key="product.id">
            <div class="rounded-lg aspect-w-1 aspect-h-1">
              <img
                class="object-cover shadow-lg rounded-lg"
                src="https://images.unsplash.com/photo-1584302179602-e4c3d3fd629d?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
              />
            </div>

            <p class="mt-4 text-lg font-medium">Gold Liberte Design Rings</p>
            <p class="mt-2 text-xl font-semibold text-indigo-600">RM 30.00</p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, ref } from 'vue'
import {
  Menu, //
  MenuButton,
  MenuItems,
  MenuItem,
  PopoverGroup,
} from '@headlessui/vue'
import { UserIcon } from '@heroicons/vue/outline'
import { useStore } from '@/store'
import { AuthActionTypes } from '@/store/modules/auth/action-types'
import { ProductActionTypes } from '@/store/modules/products/action-types'
import { Product } from '@/types'

export default defineComponent({
  components: {
    PopoverGroup,
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
    UserIcon,
  },
  setup() {
    const store = useStore()
    const products = ref([])
    const loggedIn = computed(() => store.getters.loggedIn)
    const logout = () => {
      store.dispatch(AuthActionTypes.LOGOUT)
    }

    products.value = store.dispatch(ProductActionTypes.GET_PRODUCTS)

    return { loggedIn, logout, products }
  },
})
</script>
