<script setup lang="ts">
import useAuth from '@/utils/useAuth';
import { ref } from 'vue';

const { register, errors } = useAuth();

const name = ref('');
const email = ref('');
const password = ref('');
const passwordConfirmation = ref('');

const handleRegister = () => {
  register({
    name: name.value,
    email: email.value,
    password: password.value,
    password_confirmation: passwordConfirmation.value
  });
};
</script>

<template>
  <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Register</h1>

    <form @submit.prevent="handleRegister" class="w-full max-w-md bg-white rounded-lg shadow-md px-8 py-6">
      <div class="mb-4">
        <label for="name" class="block text-sm font-bold mb-2 text-gray-700">Name:</label>
        <input v-model="name" type="text" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
        <p v-if="errors?.name" class="text-red-500 text-xs italic mt-1">{{ errors?.name[0] }}</p>
      </div>

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

      <div class="mb-4">
        <label for="passwordConfirmation" class="block text-sm font-bold mb-2 text-gray-700">Confirm Password:</label>
        <input v-model="passwordConfirmation" type="password" id="passwordConfirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
        <p v-if="errors?.password_confirmation" class="text-red-500 text-xs italic mt-1">{{ errors?.password_confirmation[0] }}</p>
      </div>

      <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Register
      </button>
    </form>
  </div>
</template>

<style scoped>
</style>
