<template>
    <nav class="bg-green-500">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex-shrink-0 flex items-center cursor-pointer" @click="$router.currentRoute.path !== '/products' && $router.push({ path: '/products' })">
                        <img class="block lg:hidden h-8 w-auto object-cover" src="https://www.supplycart.my/wp-content/uploads/2019/09/sc_logo_tm.png" alt="Workflow">
                        <img class="hidden lg:block h-8 w-auto object-cover" src="https://www.supplycart.my/wp-content/uploads/2019/09/sc_logo_tm.png" alt="Workflow">
                    </div>
                </div>
                <div v-if="token" class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <button v-on:click="$router.push({ path: '/cart' })" class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <span class="sr-only">View cart</span>
                        <svg class="h-6 w-6 fill-current text-white-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M10 19.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5zm3.5-1.5c-.828 0-1.5.671-1.5 1.5s.672 1.5 1.5 1.5 1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5zm1.336-5l1.977-7h-16.813l2.938 7h11.898zm4.969-10l-3.432 12h-12.597l.839 2h13.239l3.474-12h1.929l.743-2h-4.195z"/>
                        </svg>
                    </button>

                    <!-- Profile dropdown -->
                    <on-click-outside :do="handleClickOutside">
                        <div class="ml-3 relative group">
                            <div>
                                <button type="button" @click="open = !open" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full" src="data:image/png;base64,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" alt="">
                                </button>
                            </div>
                            <div v-show="open" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5">
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" @click="$router.currentRoute.path !== '/orders' && $router.push({ path: '/orders' })">Order History</a>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" @click="logout">Sign out</a>
                            </div>
                        </div>
                    </on-click-outside>
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
    import OnClickOutside from "./OnClickOutside.vue";
    import { mapState } from 'vuex'

    export default {
        name: "Dropdown",
        components: {
            OnClickOutside
        },
        data() {
            return {
                open: false
            }
        },
        computed: mapState({
        token: state => state.token,
        }),
        methods: {
            handleClickOutside() {
                if (this.open) {
                    this.open = false
                }
            },
            logout() {
                axios.post("/api/auth/logout", {}, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.token}`
                    }
                })
                .then(async () => {
                    localStorage.token = ''
                    await this.$store.dispatch('logout')
                    router.push({ path: '/login'})
                })
                .catch(error => {
                    console.log(error)
                })
            }
        }
    }
</script>