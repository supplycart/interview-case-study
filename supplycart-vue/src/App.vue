<script setup lang="ts">
import { RouterView } from 'vue-router';
</script>

<template>
  <div class="min-h-screen w-full">
    <header class="bg-blue-600 text-white py-4 shadow-md">
      <div class="container mx-auto px-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Supplycart</h1>
        <nav class="space-x-4">
          <RouterLink to="/" class="hover:underline">Home</RouterLink>
          <RouterLink to="/register" class="hover:underline">Register</RouterLink>
          <RouterLink to="/login" class="hover:underline">Login</RouterLink>
        </nav>
      </div>
    </header>

    <main class="flex-grow container mx-auto px-4 py-8">
      <RouterView />
    </main>

    <footer class="bg-gray-800 text-white py-4 text-center">
      <p>&copy; 2024 Supplycart. All rights reserved.</p>
    </footer>
  </div>
</template>

<style scoped>
</style>
