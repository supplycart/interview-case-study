<template>
    <nav class="bg-white border-b border-gray-100 pt-3">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div @click="$router.push({name : 'products'})"
                         class="flex-shrink-0 flex items-center cursor-pointer">
                        <img
                            src="https://blog.supplycart.my/wp-content/uploads/2019/03/Supplycart_Digital-logomark-w-workmark-PlainLogo_RGB.png"
                            height="100" width="200"/>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <navigation-link @click="$router.push({name : 'previousOrders'})" route-name="previousOrders">
                            My Orders
                        </navigation-link>
                    </div>
                </div>

                <div class="flex w-1/2 mt-2 rounded border-grey-light border" style="max-height: 40px">
                    <input v-model="search" @keyup.enter="searchProducts" class="w-full rounded ml-1" type="text"
                           placeholder="Search...">
                    <button @click="searchProducts"
                            class="bg-grey-lightest border-grey border-l shadow hover:bg-grey-lightest">
                        <span class="w-auto flex justify-end items-center text-grey p-2 hover:text-grey-darkest">
                          <i class="material-icons text-xs">search</i>
                        </span>
                    </button>
                </div>

                <!-- CART DRAWER -->
                <div class="flex w-1/5">
                    <CartDrawer/>

                    <div @mouseenter="showDropdown = true" @mouseleave="showDropdown = false" class="relative ml-2">
                        <button
                            class="p-1 flex hover:text-blue-500 hover:bg-blue-100  text-gray-700 border-2 border-transparent items-center max-w-xs text-sm rounded-full focus:outline-none"
                            id="user-menu" aria-label="User menu" aria-haspopup="true">
                            <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                      clip-rule="evenodd">
                                </path>
                            </svg>
                        </button>

                        <default-transition>
                            <div @mouseleave="showDropdown = false" v-if="showDropdown"
                                 class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg">
                                <div class="rounded-md bg-white shadow-xs">
                                    <div class="py-1" role="menu" aria-orientation="vertical"
                                         aria-labelledby="options-menu">
                                        <form method="POST" action="/logout">
                                            <input type="hidden" name="_token" :value="csrf">
                                            <button type="submit"
                                                    class="block w-full text-left px-4 py-2 text-sm leading-5 hover:bg-gray-100
                                                        hover:text-gray-900 text-color-purple focus:outline-none font-medium focus:bg-gray-100 focus:text-gray-900"
                                                    role="menuitem">
                                                Sign out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </default-transition>
                    </div>

                </div>
                <!-- // CART DRAWER -->

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = !open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import CartDrawer from "./CartDrawer";
import NavigationLink from "../core/NavigationLink";

export default {
    name: "NavigationBar",
    components: {NavigationLink, CartDrawer},
    data() {
        return {
            open: false,
            showDropdown: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    created() {
        this.$store.dispatch('user/fetchUser');
    },
    computed: {
        search: {
            get() {
                return this.$store.getters['products/search'];
            },
            set(val) {
                return this.$store.commit('products/search', val);
            }
        },
        user() {
            return this.$store.getters['user/user'];
        }
    },
    methods: {
        searchProducts() {
            // since navigation bar is always going to be in every page
            // we need to redirect to products page when a search is made
            if (this.$router.currentRoute.name !== 'products') {
                this.$router.push({name: 'products'});
            }
            this.$store.dispatch('products/products');
        }
    }
}
</script>

<style scoped>

</style>
