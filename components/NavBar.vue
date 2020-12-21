<template>
  <div>
    <nav class="bg-gray-50 dark:bg-gray-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <NuxtLink to="/home">
                <img
                  class="h-8 w-8"
                  src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg"
                  alt="Workflow"
                />
              </NuxtLink>
            </div>
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <NuxtLink
                  class="bg-gray-300 dark:bg-gray-900 dark:text-white px-3 py-2 rounded-md text-sm font-medium"
                  to="/home"
                >
                  Home
                </NuxtLink>

                <!-- <NuxtLink
                  class="text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 hover:text-black dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                  to="/todos"
                >
                  Todos
                </NuxtLink> -->
              </div>
            </div>
          </div>
          <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">
              <NuxtLink to="/cart">
                <button
                  class="bg-gray-50 dark:bg-gray-800 p-1 rounded-full text-gray-400 hover:text-gray-600 dark:hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                >
                  <span class="sr-only">View notifications</span>
                  <!-- Heroicon name: shopping-cart -->
                  <svg
                    class="h-6 w-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    aria-hidden="true"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                    />
                  </svg>
                </button>
              </NuxtLink>

              <!-- Profile dropdown -->
              <div class="ml-3 relative">
                <div>
                  <button
                    @click="menuIsOpen = !menuIsOpen"
                    v-click-outside="hideMenu"
                    class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                    id="user-menu"
                    aria-haspopup="true"
                  >
                    <span class="sr-only">Open user menu</span>
                    <img
                      class="h-8 w-8 rounded-full"
                      src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                      alt=""
                    />
                  </button>
                </div>
                <!--
                Profile dropdown panel, show/hide based on dropdown state.

                Entering: "transition ease-out duration-100"
                  From: "transform opacity-0 scale-95"
                  To: "transform opacity-100 scale-100"
                Leaving: "transition ease-in duration-75"
                  From: "transform opacity-100 scale-100"
                  To: "transform opacity-0 scale-95"
              -->
                <transition
                  enter-active-class="transition ease-out duration-100 transform"
                  enter-class="opacity-0 scale-95"
                  enter-to-class="opacity-100 scale-100"
                  leave-active-class="transition ease-in duration-75 transform"
                  leave-class="opacity-100 scale-100"
                  leave-to-class="opacity-0 scale-95"
                >
                  <!-- <div
                    v-show="menuIsOpen"
                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5"
                    role="menu"
                    aria-orientation="vertical"
                    aria-labelledby="user-menu"
                  > -->
                  <div
                    v-show="menuIsOpen"
                    class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white dark:bg-gray-900 dark:text-gray-300 ring-1 ring-black ring-opacity-5 divide-y divide-gray-100"
                    role="menu"
                    aria-orientation="vertical"
                    aria-labelledby="options-menu"
                  >
                    <div class="py-1">
                      <NuxtLink
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-800"
                        to="/order-history"
                      >
                        Order History
                      </NuxtLink>

                      <button
                        @click="logout"
                        class="text-left block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-800"
                      >
                        Sign out
                      </button>
                    </div>
                    <div class="pt-1 text-center">
                      <div class="flex justify-center align-middle mt-4">
                        <!-- Heroicon name: moon -->
                        <svg
                          class="h-6 w-6"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"
                          />
                        </svg>
                        <!-- toggle button -->
                        <div
                          class="flex justify-center items-center mx-3"
                          @click="toggleDarkMode"
                        >
                          <div
                            class="relative rounded-full w-12 h-6 transition duration-200 ease-linear"
                            :class="[toggle ? 'bg-green-400' : 'bg-gray-400']"
                          >
                            <label
                              for="toggle"
                              class="absolute left-0 bg-white border-2 mb-2 w-6 h-6 rounded-full transition transform duration-100 ease-linear cursor-pointer"
                              :class="[
                                toggle
                                  ? 'translate-x-full border-green-400'
                                  : 'translate-x-0 border-gray-400',
                              ]"
                            ></label>
                            <input
                              type="checkbox"
                              class="appearance-none w-full h-full active:outline-none focus:outline-none"
                            />
                          </div>
                        </div>
                        <!-- Heroicon name: sun -->
                        <svg
                          class="h-6 w-6"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"
                          />
                        </svg>
                        <br />
                      </div>
                      <span class="text-xs text-white dark:text-gray-200">
                        Welcome to the dark side
                      </span>
                    </div>
                  </div>
                </transition>
              </div>
            </div>
          </div>
          <div class="-mr-2 flex md:hidden">
            <!-- Mobile menu button -->
            <button
              class="dark:bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 dark:focus:ring-white"
              @click="mobileMenuIsOpen = !mobileMenuIsOpen"
            >
              <span class="sr-only">Open main menu</span>
              <!--
              Heroicon name: menu

              Menu open: "hidden", Menu closed: "block"
            -->
              <svg
                class="h-6 w-6"
                :class="mobileMenuIsOpen ? 'block' : 'hidden'"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                aria-hidden="true"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                />
              </svg>
              <!--
              Heroicon name: x

              Menu open: "block", Menu closed: "hidden"
            -->
              <svg
                class="h-6 w-6"
                :class="mobileMenuIsOpen ? 'hidden' : 'block'"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                aria-hidden="true"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!--
      Mobile menu, toggle classes based on menu state.

      Open: "block", closed: "hidden"
    -->
      <div class="md:hidden" :class="mobileMenuIsOpen ? 'hidden' : 'block'">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
          <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
          <NuxtLink
            class="bg-gray-300 dark:bg-gray-900 dark:text-white block px-3 py-2 rounded-md text-base font-medium"
            to="/home"
          >
            Home
          </NuxtLink>

          <!-- <NuxtLink
            class="text-gray-700 dark:text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
            to="/todos"
          >
            Todos
          </NuxtLink> -->
        </div>
        <div class="pt-4 border-t border-gray-700">
          <div class="flex items-center px-5">
            <div class="flex-shrink-0">
              <img
                class="h-10 w-10 rounded-full"
                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                alt=""
              />
            </div>
            <div class="ml-3">
              <div class="text-base font-medium leading-none text-white"></div>
              <div class="text-sm font-medium leading-none text-gray-400"></div>
            </div>
            <button
              class="ml-auto dark:bg-gray-800 flex-shrink-0 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
            >
              <NuxtLink to="/cart">
                <span class="sr-only">View notifications</span>
                <!-- Heroicon name: bell -->
                <svg
                  class="h-6 w-6"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  aria-hidden="true"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                  />
                </svg>
              </NuxtLink>
            </button>
          </div>
          <div class="mt-3 px-2 space-y-1">
            <NuxtLink
              class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700"
              to="/order-history"
            >
              Order History
            </NuxtLink>

            <button
              @click="logout"
              class="text-left block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700"
            >
              Sign out
            </button>
          </div>
          <div class="pt-1">
            <div class="pt-1 text-center">
              <div class="flex justify-center align-middle">
                <!-- Heroicon name: moon -->
                <svg
                  class="h-6 w-6 dark:text-gray-300"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"
                  />
                </svg>
                <!-- toggle button -->
                <div
                  class="flex justify-center items-center mx-3"
                  @click="toggleDarkMode"
                >
                  <div
                    class="relative rounded-full w-12 h-6 transition duration-200 ease-linear"
                    :class="[toggle ? 'bg-green-400' : 'bg-gray-400']"
                  >
                    <label
                      for="toggle"
                      class="absolute left-0 bg-white border-2 mb-2 w-6 h-6 rounded-full transition transform duration-100 ease-linear cursor-pointer"
                      :class="[
                        toggle
                          ? 'translate-x-full border-green-400'
                          : 'translate-x-0 border-gray-400',
                      ]"
                    ></label>
                    <input
                      type="checkbox"
                      class="appearance-none w-full h-full active:outline-none focus:outline-none"
                    />
                  </div>
                </div>
                <!-- Heroicon name: sun -->
                <svg
                  class="h-6 w-6 dark:text-gray-300"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"
                  />
                </svg>
                <br />
              </div>
              <span class="text-xs text-white dark:text-gray-200">
                Welcome to the dark side
              </span>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
</template>


<script>
import ClickOutside from "vue-click-outside";
import { mapMutations } from "vuex";

import firebase from "firebase/app";
import "firebase/auth";

export default {
  data: () => ({
    menuIsOpen: false,
    mobileMenuIsOpen: true,
    toggle: false,
  }),

  computed: {
    todos() {
      return this.$store.state.isDark;
    },
  },
  methods: {
    hideMenu() {
      this.menuIsOpen = false;
    },
    toggleDarkMode() {
      this.toggle = !this.toggle;
      this.$parent.isDark = !this.$parent.isDark;
    },
    ...mapMutations({
      toggle: "darkMode/toggleDark",
    }),
    logout() {
      console.log("logout");

      firebase
        .auth()
        .signOut()
        .then(() => {
          this.$router.push("/login");
        });
    },
  },
  mounted() {
    // prevent click outside event with popupItem.
    this.popupItem = this.$el;
  },
  // do not forget this section
  // to close opened menu when click outside of menu
  directives: {
    ClickOutside,
  },
};
</script>