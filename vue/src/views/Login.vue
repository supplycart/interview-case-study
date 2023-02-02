<template>
  <div>
    <img class="mx-auto h-24 w-auto" src="/logo.jpg" alt="Supplycart" />
    <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Sign in to your account</h2>
  </div>
  <form class="mt-8 space-y-6" @submit="login">
    <Alert v-if="errorMsg">
      {{ errorMsg }}
      <span
        @click="errorMsg = ''"
        class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-[rgba(0,0,0,0.2)]"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M6 18L18 6M6 6l12 12"
          />
        </svg>
      </span>
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
    .catch((err) => {
      errorMsg.value = err.response.data.error;
    });
}

</script>