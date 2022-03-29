<template>
    <loading-overlay v-if="loading"/>
    <div v-if="user !== null && user.role == 1" class="bg-red-200 w-full py-1 flex flex-row justify-center">
        <div class="mr-6">Join Membership to enjoy a 5% discount storewide!</div>
        <button class="border-2 border-emerald-400 px-4 rounded-full hover:text-white hover:bg-emerald-400" @click="upgrade">Join Now</button>
    </div>
    <Disclosure as="nav" class="bg-sky-100" v-slot="{ open }">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-20">
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex-shrink-0 flex items-center">
                        <router-link to="/">
                            <img class="block h-8 w-auto" src="/images/logo.webp" alt="SupplyCart" />
                        </router-link>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-5 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <router-link to="/my-cart">
                        <button type="button" class="bg-invisible-800 p-1 rounded-full text-gray-800 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                            <span class="sr-only">View Carts</span>
                            <ShoppingCartIcon class="h-7 w-7" aria-hidden="true" />
                        </button>
                    </router-link>
                    <!-- Profile dropdown -->
                    <Menu as="div" class="ml-5 relative">
                        <div>
                            <MenuButton class="bg-white flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-300 shadow-md">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-14 w-14 rounded-full" :src="avatar" :alt="user == null ? 'profile picture' : user.username" />
                            </MenuButton>
                        </div>
                        <transition enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="origin-top-right absolute right-0 mt-2 w-max rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-30">
                                <MenuItem>
                                    <div class="px-4 py-2 inline-block">
                                        <span class="font-bold">{{user.username}}</span>
                                        <span class="inline-block ml-4 border-2 px-2 rounded-full"
                                              :class="{'text-yellow-500 border-yellow-500': user.role == 2,
                                                        'border-emerald-300 text-emerald-300': user.role == 1}">
                                            {{user.role == 1 ? "Customer" : "Member"}}
                                        </span>
                                    </div>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <router-link to="/orders" class="text-center" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">My Orders</router-link>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <router-link to="/history" class="text-center" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">My Activities</router-link>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <p @click="logout()" class="text-center" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700 cursor-pointer']">Sign out</p>
                                </MenuItem>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
            </div>
        </div>

        <DisclosurePanel class="sm:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <DisclosureButton v-for="item in navigation" :key="item.name" as="a" :href="item.href" :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'block px-3 py-2 rounded-md text-base font-medium']" :aria-current="item.current ? 'page' : undefined">{{ item.name }}</DisclosureButton>
            </div>
        </DisclosurePanel>
    </Disclosure>
    <information-dialog :error="!success" :description="message" :is-open="showDialog" title="User upgrading" @close="onClose"/>
</template>

<script>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ShoppingCartIcon } from '@heroicons/vue/solid'
import { createAvatar } from '@dicebear/avatars';
import * as style from '@dicebear/croodles';
import LoadingOverlay from "./LoadingOverlay";
import InformationDialog from "./InformationDialog";

export default {
    name: "NavBar",
    components: {
        InformationDialog,
        LoadingOverlay,
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        ShoppingCartIcon
    },
    data() {
        return {
            user: null,
            avatar: "",
            loading: false,
            showDialog: false,
            success: false,
            message: ""
        }
    },
    methods: {
        logout() {
            axios.get("/api/logout")
                .then(() => {
                    this.$router.push("/login");
                });
        },
        async upgrade() {
            this.loading = true;
            await axios.post("/api/user/upgrade")
                .then((res) => {
                    this.success = true;
                    this.message = "Upgraded successfully, please enjoy your 5% discount storewide!."
                }).catch((e) => {
                    this.success = false;
                    this.message = e.response.error;
                }).finally(() => {
                    this.loading = false;
                    this.showDialog = true;
                });
        },
        onClose() {
            this.showDialog = false;
            if (this.success) {
                window.location.reload();
            }
        }
    },
    mounted() {
        this.user = window.auth_user;
        this.avatar = createAvatar(style, {
            seed: this.user.email,
            dataUri: true
        });
    }
}
</script>
