<template>
  <div class="relative bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
      <div
        class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10"
      >
        <div class="lg:w-0 lg:flex-1">
          <img @click="redirectToHomepage" src="/images/sc.png" alt="supplycart logo" class="h-8 w-auto" style="cursor: pointer">
        </div>
        <nav class="hidden md:flex space-x-10" v-if="currentUserToken != null">
          <a
            @click="redirectToCart"
            class="cursor-pointer text-base leading-6 font-medium text-gray-500 hover:text-teal-600 focus:outline-none focus:text-teal-700 transition ease-in-out duration-150"
          >
          <i class="las la-shopping-cart text-lg"></i>
            Cart & Purchase history
          </a>
          <router-link
            to="/products"
            class="cursor-pointer text-base leading-6 font-medium text-gray-500 hover:text-teal-600 focus:outline-none focus:text-teal-700 transition ease-in-out duration-150"
          >
          <i class="las la-store text-lg"></i>
            All Products
          </router-link>
        </nav>
        <div
          class="hidden md:flex items-center justify-end space-x-8 md:flex-1 lg:w-0"
        >
          <router-link
            v-if="currentUserToken == null"
            to="/login"
            class="whitespace-no-wrap text-base leading-6 font-medium text-gray-500 hover:text-teal-600 focus:outline-none focus:text-teal-700"
          >
            Sign In
          </router-link>
          <a
            v-if="currentUserToken != null"
            class="cursor-default whitespace-no-wrap text-base leading-6 font-medium text-gray-500 hover:text-teal-600 focus:outline-none focus:text-teal-700"
          >
            {{ currentUserName }}
          </a>
          <span class="inline-flex rounded-md shadow-sm">
            <router-link
              v-if="currentUserToken == null"
              to="/registration"
              class="whitespace-no-wrap inline-flex items-center justify-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150"
            >
              Sign up
            </router-link>
            <a
              v-if="currentUserToken != null"
              @click="logout" 
              class="cursor-pointer whitespace-no-wrap inline-flex items-center justify-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150"
            >
              Sign out
            </a>
          </span>
        </div>
      </div>
    </div>
    <div
      class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden"
    >
      <div class="rounded-lg shadow-lg">
        <div class="rounded-lg shadow-xs bg-white divide-y-2 divide-gray-50">
          <div class="py-6 px-5 space-y-6">
            <div class="space-y-6">
              <span class="w-full flex rounded-md shadow-sm">
                <a
                  href="#"
                  class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150"
                >
                  Sign up
                </a>
              </span>
              <p
                class="text-center text-base leading-6 font-medium text-gray-500"
              >
                Existing customer?
                <a
                  href="#"
                  class="text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150"
                >
                  Sign in
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Axios from 'axios'
export default {
  data() {
    return {
      currentUserToken: localStorage.getItem('currentUser'),
      currentUserName: localStorage.getItem('currentUserName'),
      currentUserID: localStorage.getItem('currentUserID')
    }
  },

  methods: {
    redirectToHomepage() {
      this.$router.push('/')
    },

    redirectToCart() {
      this.$router.push({
        name: 'cartAndHistory',
        params: {
          currentUserID: this.currentUserID
        }
      })
    },

    logout() {
      Axios.post('/api/logout')
        .then(response => {
          localStorage.clear()

          this.currentUserToken = localStorage.getItem('currentUser');
          this.currentUserName = localStorage.getItem('currentUserName');
          this.currentUserID = localStorage.getItem('currentUserID');

          this.$router.push('/')
        })
    }
  }
}
</script>