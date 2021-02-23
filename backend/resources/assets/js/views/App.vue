<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <div class="relative bg-white">
                    <div
                        class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10"
                    >
                        <div class="flex justify-start lg:w-0 lg:flex-1">
                            <router-link
                                :to="{ name: 'home' }"
                                class="navbar-brand"
                                ><img
                                    class="h-8 w-auto sm:h-10"
                                    src="https://upload.wikimedia.org/wikipedia/commons/0/0d/Circle-icons-trends.svg"
                                    alt=""
                            /></router-link>
                            <span class="px-8 text-3xl font-semibold">Outdoor Gear Store</span>
                        </div>
                        <div
                            class="hidden md:flex items-center justify-end md:flex-1 lg:w-0"
                            v-if="!isLoggedIn"
                        >
                            <router-link
                                :to="{ name: 'login' }"
                                class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"
                                >Login</router-link
                            >
                            <router-link
                                :to="{ name: 'register' }"
                                class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-green-600 hover:bg-green-700"
                                >Register</router-link
                            >
                        </div>
                        <div v-if="isLoggedIn">
                            <router-link
                                :to="{ name: 'userboard' }"
                                class="nav-link"
                                v-if="user_type == 0"
                            >
                                Hi, {{ name }}</router-link
                            >
                            <router-link
                                :to="{ name: 'admin' }"
                                class="nav-link"
                                v-if="user_type == 1"
                            >
                                Hi, {{ name }}</router-link
                            >

                            <span
                                class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-green-600 hover:bg-green-700"
                                v-if="isLoggedIn"
                                @click="logout"
                            >
                                Logout
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <main class="py-4">
            <router-view @loggedIn="change"></router-view>
        </main>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: null,
            user_type: 0,
            isLoggedIn: localStorage.getItem("bigStore.jwt") != null,
        };
    },
    mounted() {
        this.setDefaults();
    },
    methods: {
        setDefaults() {
            if (this.isLoggedIn) {
                let user = JSON.parse(localStorage.getItem("bigStore.user"));
                this.name = user.name;
                this.user_type = user.is_admin;
            }
        },
        change() {
            this.isLoggedIn = localStorage.getItem("bigStore.jwt") != null;
            this.setDefaults();
        },
        logout() {
            localStorage.removeItem("bigStore.jwt");
            localStorage.removeItem("bigStore.user");
            this.change();
            this.$router.push("/");
        },
    },
};
</script>
