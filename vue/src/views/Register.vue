
<template>
    <!--
      This example requires updating your template:
  
      ```
      <html class="h-full bg-gray-50">
      <body class="h-full">
      ```
    -->
  <div>
    <img class="mx-auto h-24 w-auto" src="/logo.jpg" alt="Supplycart" />
    <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">New User</h2>
  </div>

  <form class="mt-8 space-y-6" @submit="register">
    <Alert v-if="Object.keys(errors).length" class="flex-col items-stretch text-sm">
      <div v-for="(field, i) of Object.keys(errors)" :key="i">
        <div v-for="(error, ind) of errors[field] || []" :key="ind">
          * {{ error }}
        </div>
      </div>
    </Alert>
    <input type="hidden" name="remember" value="true" />
    <div class="-space-y-px rounded-md shadow-sm">
      <div>
        <label for="name" class="sr-only">Name</label>
        <input id="name" name="name" type="text" autocomplete="name" required="" class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-[#1e3454] focus:outline-none focus:ring-[#1e3454] sm:text-sm" placeholder="Full name" v-model="user.name"
        :class="{ 'border-red-500': errors.name, 'z-10': errors.name }"
        />
      </div>
      <div>
        <label for="email" class="sr-only">Email address</label>
        <input id="email" name="email" type="email" autocomplete="email" required="" class="relative block w-full appearance-none rounded-none border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-[#1e3454] focus:outline-none focus:ring-[#1e3454] sm:text-sm" placeholder="Email address" v-model="user.email"
        :class="{ 'border-red-500': errors.email, 'z-10': errors.email }"
        />
      </div>
      <div>
        <label for="password" class="sr-only">Password</label>
        <input id="password" name="password" type="password" autocomplete="current-password" required="" class="relative block w-full appearance-none rounded-none border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-[#1e3454] focus:outline-none focus:ring-[#1e3454] sm:text-sm" placeholder="Password" v-model="user.password"
        :class="{ 'border-red-500': errors.password, 'z-10': errors.password }"
        />
      </div>
      <div>
        <label for="password_confirmation" class="sr-only">Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="current-password" required="" class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-[#1e3454] focus:outline-none focus:ring-[#1e3454] sm:text-sm" placeholder="Password Confirmation" v-model="user.password_confirmation"
        :class="{ 'border-red-500': errors.password_confirmation, 'z-10': errors.password_confirmation }"
        />
      </div>
    </div>

    <div class="flex items-center justify-between">

      <div class="text-sm">
        <router-link :to="{name: 'Login'}" class="font-medium text-indigo-600 hover:text-indigo-500">Already have account?</router-link>
      </div>
    </div>
    <div>
      <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent ba py-2 px-4 text-sm font-medium text-white bg-[#051d41] hover:bg-[#1e3454] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Register
      </button>
    </div>
  </form>
</template>
  
<script setup>
import store from '../store';
import { useRouter } from "vue-router";
import { ref } from "vue";
import Alert from "../components/Alert.vue";

const router = useRouter();
const user={
  name:"",
  email:"",
  password:"",
};

let errors = ref({});

function register(ev){
  ev.preventDefault();
  store
    .dispatch('register',user)
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