<script setup>
import { ref, computed } from 'vue';
import { RouterLink } from 'vue-router';
import { useAuthStore } from '../stores/auth'; 

const authStore = useAuthStore();
const isAuthenticated = computed(() => authStore.isLoggedIn);
const userName = computed(() => authStore.user?.name || '');

// Handle logout
const handleLogout = () => {
  authStore.logout();
};
</script>

<template>
  <nav class="bg-gray-800 p-4 text-white flex justify-between items-center">
    <!-- Logo/Store Name -->
    <RouterLink to="/" class="text-2xl font-bold">
      Supplycart
    </RouterLink>

    <!-- Cart and User Section -->
    <div class="flex items-center space-x-4">
      <!-- Cart Icon -->
      <RouterLink to="/cart" class="relative">
        <font-awesome-icon icon="shopping-cart" class="text-2xl" />
        <!-- Optional: Cart item count (if you track cart items) -->
        <span class="absolute top-0 right-0 bg-red-500 text-white rounded-full px-2 text-xs">3</span>
      </RouterLink>

      <!-- User Icon/Authentication -->
      <div class="relative flex items-center">
        <font-awesome-icon icon="user" class="text-2xl" />
        <div class="ml-2">
          <!-- If authenticated, show user's name and dropdown -->
          <div v-if="isAuthenticated">
            <span>{{ userName }}</span>
            <button @click="handleLogout" class="ml-4 bg-red-500 px-2 py-1 rounded text-white">
              Logout
            </button>
          </div>

          <!-- If not authenticated, show Login and Register buttons -->
          <div v-else>
            <RouterLink to="/login" class="ml-4">
              Login
            </RouterLink>
            <RouterLink to="/register" class="ml-4">
              Register
            </RouterLink>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<style scoped>

</style>
