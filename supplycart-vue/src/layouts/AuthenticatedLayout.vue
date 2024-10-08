<template>
    <div v-if="auth">
      <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-100">
          <!-- Primary Navigation Menu -->
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
              <!-- Left side -->
              <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                  <router-link to="/">
                    <ApplicationLogo class="block h-9 w-auto" />
                  </router-link>
                </div>
              </div>
  
              <!-- Right side -->
              <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                  <Dropdown align="right" width="48">
                    <template #trigger>
                      <span class="inline-flex rounded-md">
                        <button
                          type="button"
                          class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                          {{ store.userData.name }}
  
                          <svg
                            class="ml-2 -mr-0.5 h-4 w-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                              fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                          </svg>
                        </button>
                      </span>
                    </template>
  
                    <template #content>
                      <DropdownLink @click="submitLogout">
                        Log Out
                      </DropdownLink>
                    </template>
                  </Dropdown>
                </div>
              </div>
            </div>
          </div>
        </nav>
  
        <!-- Page Heading -->
        <header v-if="$slots.header" class="bg-white shadow">
          <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <slot name="header" />
          </div>
        </header>
  
        <!-- Page Content -->
        <main>
          <slot />
        </main>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref, onBeforeMount } from 'vue';
  import { useUsers } from '@/stores/user';
  import ApplicationLogo from '@/components/ApplicationLogo.vue';
  import Dropdown from '@/components/Dropdown.vue';
  import DropdownLink from '@/components/DropdownLink.vue';
  
  const showingNavigationDropdown = ref(false);
  const store = useUsers();
  const auth = store.authUser;
  
  onBeforeMount(() => {
    if (!store.hasUserData) {
      store.getData();
    }
  });
  
  const submitLogout = () => {
    store.logout();
  };
  </script>
  