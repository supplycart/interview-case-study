<template>
  <nav class="relative flex flex-wrap items-center justify-between px-2 py-3 navbar-expand-lg bg-indigo-500 mb-3">
    <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
      <div class="w-full relative flex justify-between lg:w-auto  px-4 lg:static lg:block lg:justify-start">
        <a class="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-no-wrap uppercase text-white" href="#pablo">
          <img
              src="https://blog.supplycart.my/wp-content/uploads/2019/03/Supplycart_Digital-logomark-w-workmark-PlainLogo_RGB.png"
              width="200"/>
        </a>
        <button
            class="text-white cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
            type="button" v-on:click="toggleNavbar()">
          <i class="fas fa-bars"></i>
        </button>
      </div>
      <div v-bind:class="{'hidden': !showMenu, 'flex': showMenu}" class="lg:flex lg:flex-grow items-center">
        <ul class="flex flex-col lg:flex-row list-none ml-auto">
          <template v-if="user">

            <li class="nav-item">
              <router-link :to="{ name: 'products' }" class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-75">
                <span class="ml-2">Products</span>
              </router-link>
            </li>
            <li class="nav-item">
              <div>
                <button
                    class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-75"
                    type="button" style="transition: all .15s ease" v-on:click="toggleModal()">
                  <span class="ml-2">Cart (<span id="cart_count">{{ carts ? carts.length : 0 }}</span>)</span>

                </button>
                <div v-if="showModal"
                     class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
                  <div class="relative w-auto my-6 mx-auto max-w-6xl w-12/12 md:w-8/12 lg:w-5/12">
                    <!--content-->
                    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                      <!--header-->
                      <div class="flex items-start justify-between p-5 border-b border-solid border-gray-300 rounded-t">
                        <h3 class="text-3xl font-semibold">
                          Carts
                        </h3>
                        <button
                            class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                            v-on:click="toggleModal()">
              <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                ×
              </span>
                        </button>
                      </div>
                      <!--body-->
                      <div class="relative p-6 flex-auto">
                        <div class="flex mt-6 mb-5">
                          <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product</h3>
                          <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
                          <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                          <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
                        </div>

                        <div v-for="({qty,product},i ) in carts" :key="product.id">

                          <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                            <div class="flex w-2/5"> <!-- product -->
                              <div class="w-20">
                                <img class="h-24" :src="product.image" alt="">
                              </div>
                              <div class="flex flex-col justify-between ml-4 flex-grow">
                                <span class="font-bold text-sm">{{ product.name }}</span>
                                <span class="text-red-500 text-xs">{{ product.brand.name }}</span>
                                <a href="#" class="font-semibold hover:text-red-500 text-gray-500 text-xs" @click="carts.splice(i, 1)">Remove</a>
                              </div>
                            </div>
                            <div class="flex justify-center w-1/5 ">
                              <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512" @click="carts[i].qty -= 1" :disabled="carts[i].qty <= 1">
                                <path d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                              </svg>

                              <input class="mx-2 border text-center w-8" type="text" v-model="carts[i].qty">

                              <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512" @click="carts[i].qty += 1">
                                <path
                                    d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                              </svg>
                            </div>
                            <span class="text-center w-1/5 font-semibold text-sm">${{ product.price }}</span>
                            <span class="text-center w-1/5 font-semibold text-sm">${{ qty * product.price }}</span>
                          </div>
                        </div>


                      </div>
                      <!--footer-->
                      <div class="flex items-center justify-end p-6 border-t border-solid border-gray-300 rounded-b">
                        <button
                            class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1"
                            type="button" style="transition: all .15s ease" v-on:click="toggleModal()">
                          Continue Shopping
                        </button>
                        <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1"
                                type="button" style="transition: all .15s ease" v-on:click="checkout">
                          Checkout
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
              </div>
            </li>

            <div class="flex">
              <div class="relative">
                <button
                    class="rounded-full overflow-hidden border-2 border-purple-500 w-30 h-10 flex justify-center items-center | hover:border-white focus:outline-none focus:border-white"
                    @mouseover="isOpen1 = true"
                >
                  <span class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-75">
                 {{ user.name }} <i class="fas fa-caret-square-down"></i> </span>
                </button>

                <div v-if="isOpen1" class="fixed inset-0 w-full h-screen z-20 bg-black opacity-25" @click="isOpen1 = false"></div>
                <div v-if="isOpen1" class="absolute z-30 right-0 mt-2" :class="{'hidden': !isOpen1}">
                  <div class="bg-white rounded-lg shadow-lg py-2 w-48">
                    <a href="#" class="block text-purple-600 font-semibold px-4 py-2 | hover:text-white hover:bg-purple-500">Orders History</a>
                    <a href="#" class="block text-purple-600 font-semibold px-4 py-2 | hover:text-white hover:bg-purple-500">Activity Log</a>
                    <a href="#" @click.prevent="logout"
                       class="block text-purple-600 font-semibold px-4 py-2 | hover:text-white hover:bg-purple-500">Sign out</a>
                  </div>
                </div>
              </div>
            </div>
          </template>
          <template v-else>
            <li class="nav-item">
              <router-link :to="{ name: 'login' }" class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-75">
                <span class="ml-2">Login</span>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'register' }" class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-75">
                <span class="ml-2">Register</span>
              </router-link>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import {mapGetters} from 'vuex'

export default {
  name: "indigo-navbar",
  data() {
    return {
      showMenu: true,
      showModal: false,
      isOpen1: false,
    }
  },

  computed: mapGetters({
    user: 'auth/user',
    carts: 'carts/carts',
  }),

  methods: {
    toggleNavbar: function () {
      this.showMenu = !this.showMenu;
    },
    toggleModal: function () {

      let carts = this.carts.map(cart => {
        return {product_id: cart.product_id, qty: cart.qty}
      });
      this.$store.dispatch('carts/syncCart', carts)
      this.showModal = !this.showModal;
    },
    async logout() {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({name: 'login'})
    },
    async checkout() {
      this.showModal = !this.showModal;
      // checkout the cart.
      let carts = this.carts.map(cart => {
        return {product_id: cart.product_id, qty: cart.qty}
      });
      await this.$store.dispatch('carts/syncCart', carts)
      await this.$store.dispatch('carts/checkout', carts)

      // Redirect to login.
      this.$router.push({name: 'orders'})
    }
  }
}
</script>