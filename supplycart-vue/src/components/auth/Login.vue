<script setup lang="ts">
import useAuth from '@/utils/useAuth';
import { ref } from 'vue';

const { login, errors } = useAuth();

const email = ref('');
const password = ref('');

const handleLogin = () => {
  login({
    email: email.value,
    password: password.value
  });
};
</script>

<template>
  <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Login</h1>

    <form @submit.prevent="handleLogin" class="w-full max-w-md bg-white rounded-lg shadow-md px-8 py-6">
      <div class="mb-4">
        <label for="email" class="block text-sm font-bold mb-2 text-gray-700">Email:</label>
        <input v-model="email" type="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
        <p v-if="errors?.email" class="text-red-500 text-xs italic mt-1">{{ errors?.email[0] }}</p>
      </div>

      <div class="mb-4">
        <label for="password" class="block text-sm font-bold mb-2 text-gray-700">Password:</label>
        <input v-model="password" type="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
        <p v-if="errors?.password" class="text-red-500 text-xs italic mt-1">{{ errors?.password[0] }}</p>
      </div>

      <div v-if="errors?.message" class="mb-4">
        <p class="text-red-500 text-xs italic">{{ errors.message[0] }}</p>
      </div>

      <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Login
      </button>
    </form>
  </div>
</template>

<style scoped>
</style>
