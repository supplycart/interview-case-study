<script setup>
import { ref, computed } from 'vue';
import { RouterLink } from 'vue-router';
import { useAuthStore } from '../stores/auth'; 
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faShoppingCart, faUser, faHistory } from '@fortawesome/free-solid-svg-icons';
import Dropdown from '@/components/Dropdown.vue'; // Import Dropdown component

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
    <RouterLink to="/" class="text-xl font-semibold hover:text-gray-300">
      Supplycart
    </RouterLink>

    <!-- Cart and User Section -->
    <div class="flex items-center space-x-6">
      <!-- Order History Icon -->
      <RouterLink to="/order-history" class="hover:text-gray-300">
        <font-awesome-icon :icon="faHistory" class="text-xl" />
      </RouterLink>

      <!-- Cart Icon -->
      <RouterLink to="/cart" class="relative hover:text-gray-300">
        <font-awesome-icon :icon="faShoppingCart" class="text-xl" />
      </RouterLink>

      <!-- User Icon/Authentication -->
      <div class="relative flex items-center space-x-2">
        <!-- Show profile icon and name if logged in -->
        <Dropdown v-if="isAuthenticated" align="right" width="48">
          <!-- Trigger for dropdown: User icon and name -->
          <template #trigger>
            <div class="flex items-center space-x-1 cursor-pointer">
              <font-awesome-icon :icon="faUser" class="text-xl" />
              <span class="text-sm font-medium">{{ userName }}</span>
            </div>
          </template>

          <!-- Dropdown content: Logout -->
          <template #content>
            <button 
              @click="handleLogout" 
              class="block w-full text-left px-4 py-2 text-black text-sm hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
            >
              Logout
            </button>
          </template>
        </Dropdown>

        <!-- If not authenticated, show Login and Register buttons -->
        <div v-else class="flex space-x-4">
          <RouterLink to="/login" class="hover:underline">
            Login
          </RouterLink>
          <RouterLink to="/register" class="hover:underline">
            Register
          </RouterLink>
        </div>
      </div>
    </div>
  </nav>
</template>

