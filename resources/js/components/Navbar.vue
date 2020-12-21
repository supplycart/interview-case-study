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
              <router-link :to="{ name: 'login' }" class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-75">
                <span class="ml-2">Cart (0)</span>
              </router-link>
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
                    <a href="#" class="block text-purple-600 font-semibold px-4 py-2 | hover:text-white hover:bg-purple-500" @click.prevent="logout">Sign
                      out</a>
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
      isOpen1: false,
    }
  },

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    toggleNavbar: function () {
      this.showMenu = !this.showMenu;
    },
    async logout() {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({name: 'login'})
    }
  }
}
</script>