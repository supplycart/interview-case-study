<template>
    <nav class="bg-blue-600 text-white shadow-lg">
      <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4">
          <router-link to="/" class="text-2xl font-bold hover:text-blue-200">E-Shop</router-link>
  
          <div class="flex items-center space-x-6">
            <router-link to="/products" class="hover:text-blue-200" v-if="isLoggedIn">Products</router-link>
  
            <template v-if="isLoggedIn">
              <router-link to="/cart" class="relative hover:text-blue-200">
                🛒 Cart
                <span v-if="cartItemCount > 0" class="absolute -top-2 -right-2 bg-red-500 text-xs rounded-full h-5 w-5 flex items-center justify-center">
                  {{ cartItemCount }}
                </span>
              </router-link>
              <router-link to="/orders" class="hover:text-blue-200">My Orders</router-link>
              <span class="text-blue-100">Welcome, {{ currentUser?.name }}!</span>
              <button @click="logout" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Logout
              </button>
            </template>
            <template v-else>
              <router-link to="/login" class="hover:text-blue-200">Login</router-link>
              <router-link to="/register" class="hover:text-blue-200">Register</router-link>
            </template>
          </div>
        </div>
      </div>
    </nav>
  </template>
  
  <script>
  import { mapState, mapActions } from 'pinia';
  import { useAuthStore } from '@/stores/authStore';
  import { useCartStore } from '@/stores/cartStore';
  
  export default {
    name: 'Navbar',
    computed: {
      ...mapState(useAuthStore, ['isLoggedIn', 'currentUser']),
      ...mapState(useCartStore, { cartItemCount: 'itemCount' }), // Map itemCount getter
    },
    methods: {
      ...mapActions(useAuthStore, ['handleLogout']),
      logout() {
        this.handleLogout();
        // Router will redirect automatically via store action or navigation guard
      }
    }
  };
  </script>
  