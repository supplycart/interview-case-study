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
          <!--          <li class="nav-item">-->
          <!--            <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-75" href="#pablo">-->
          <!--              <i class="fa fa-user-pluz text-lg leading-lg text-white opacity-75"/><span class="ml-2">Register</span>-->
          <!--            </a>-->
          <!--          </li>-->
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "indigo-navbar",
  data() {
    return {
      showMenu: true
    }
  },
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