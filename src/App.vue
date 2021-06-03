<template>
  <div class="max-w-full mx-auto">
    <!-- <div
      class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10"
    >
      <div class="flex justify-start lg:w-0 lg:flex-1">
        <a href="#">
          <span class="sr-only">Workflow</span>
          <img
            class="h-8 w-auto sm:h-10"
            src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
            alt=""
          />
        </a>
      </div>
      <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
        <router-link
          to="/login"
          class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"
        >
          Sign in
        </router-link>
        <router-link
          to="/register"
          class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"
        >
          Sign up
        </router-link>
      </div>
    </div> -->

    <router-view />
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  setup(): Record<string, unknown> {
    return {};
  },
});
</script>
