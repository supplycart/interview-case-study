<script setup lang="ts">
import { ref, computed } from 'vue';
import { useUsers } from '@/stores/user'; // User store for authentication

const store = useUsers();
const isAuthenticated = computed(() => store.authUser);
const userName = computed(() => store.userData?.name || 'User'); // Adjust according to how you manage user data
</script>


<template>
    <!-- Header -->
    <header class="bg-gray-50 border-b border-gray-200 p-4 flex justify-between items-center">
      <!-- Store name -->
      <router-link to="/" class="text-2xl font-semibold text-gray-900">Supplycart</router-link>
  
      <!-- Right side (Cart Icon and User) -->
      <div class="flex items-center space-x-6">
        <!-- Cart Icon -->
        <router-link to="/cart" class="relative">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-gray-700">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l1.3 5.5a1 1 0 001 .5h6.4a1 1 0 001-.5L17 13M5 5h14M16 21a1 1 0 100-2 1 1 0 000 2zm-8 0a1 1 0 100-2 1 1 0 000 2z" />
          </svg>
          <!-- Optional: Cart item count -->
          <span class="absolute top-0 right-0 bg-red-500 text-white rounded-full px-2 text-xs">3</span>
        </router-link>
        
        <!-- User Authentication -->
        <div v-if="isAuthenticated" class="flex items-center space-x-2">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-gray-700">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A8.964 8.964 0 0112 15c2.21 0 4.21.807 5.879 2.146M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c3.866 0 7 3.134 7 7H5c0-3.866 3.134-7 7-7z" />
          </svg>
          <span class="text-gray-700">{{ userName }}</span>
        </div>
  
        <!-- If not authenticated, show Login/Register -->
        <div v-else class="flex items-center space-x-4">
          <router-link to="/login" class="text-gray-700 hover:text-gray-900">Login</router-link>
          <router-link to="/register" class="text-gray-700 hover:text-gray-900">Register</router-link>
        </div>
      </div>
    </header>
  
    <!-- Main content -->
    <router-view></router-view>
  </template>
  

  <style scoped>
  header {
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
  }
  </style>
  