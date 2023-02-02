<template>
  <div>
    <img class="mx-auto h-24 w-auto" src="/logo.jpg" alt="Supplycart" />
    <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Sign in to your account</h2>
  </div>
  <form class="mt-8 space-y-6" @submit="login">
    <Alert v-if="Object.keys(errors).length" class="flex-col items-stretch text-sm">
      <div v-for="(field, i) of Object.keys(errors)" :key="i">
        <div v-for="(error, ind) of errors[field] || []" :key="ind">
          * {{ error }}
        </div>
      </div>
    </Alert>
    
    <input type="hidden" name="remember" value="true"/>
    <div class="-space-y-px rounded-md shadow-sm">
      <div>
        <label for="email-address" class="sr-only">Email address</label>
        <input
          id="email-address"
          name="email"
          type="email"
          autocomplete="email"
          required=""
          v-model="user.email"
          class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
          placeholder="Email address"
          :class="{ 'border-red-500': errors.email, 'z-10': errors.email }"
        />      
      </div>
      <div>
        <label for="password" class="sr-only">Password</label>
        <input
          id="password"
          name="password"
          type="password"
          autocomplete="current-password"
          required=""
          v-model="user.password"
          class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
          placeholder="Password"
          :class="{ 'border-red-500': errors.password, 'z-10': errors.password }"
        />      
      </div>
    </div>

    <div class="flex items-center justify-between">
      <div class="flex items-center">
        <input
          id="remember-me"
          name="remember-me"
          type="checkbox"
          v-model="user.remember"
          class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
        />
        <label for="remember-me" class="ml-2 block text-sm text-gray-900">
          Remember me
        </label>
      </div>

      <div class="text-sm">
        <router-link :to="{name: 'Register'}" class="font-medium text-indigo-600 hover:text-indigo-500">New user?</router-link>
      </div>
    </div>

    <div>
      <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent ba py-2 px-4 text-sm font-medium text-white bg-[#051d41] hover:bg-[#1e3454] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Sign in
      </button>
    </div>
  </form>
</template>

<script setup>
import store from "../store";
import { useRouter } from "vue-router";
import {ref} from "vue";
import Alert from "../components/Alert.vue";

const router = useRouter();

const user = {
  email: "",
  password: "",
};

let errors = ref({});
let errorMsg = ref('');

function login(ev) {
  ev.preventDefault();
  store
    .dispatch("login", user)
    .then(() => {
      router.push({
        name: "Dashboard",
      });
    })
    .catch((error) => {
      if (error.response.status === 422) {
        errors.value = error.response.data.errors;
      }
    });
}

</script>