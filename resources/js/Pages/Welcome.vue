<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

const products = ref([
    {
        id: 1,
        name: "Laptop",
        price: 999.99,
        image: "https://placecats.com/200/200",
    },
    {
        id: 2,
        name: "Smartphone",
        price: 499.99,
        image: "https://placecats.com/201/201",
    },
    {
        id: 3,
        name: "Headphones",
        price: 99.99,
        image: "https://placecats.com/202/202",
    },
    {
        id: 4,
        name: "Smartwatch",
        price: 199.99,
        image: "https://placecats.com/203/203",
    },
]);

const mobileMenuOpen = ref(false);

const toggleMobileMenu = () => {
    mobileMenuOpen.value = !mobileMenuOpen.value;
};
</script>

<template>
    <Head title="E-commerce Store" />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Navigation Bar -->
        <nav class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <img
                                class="h-8 w-auto"
                                src="images/logo.png"
                                alt="Logo"
                            />
                        </div>
                        <!-- Navigation Links -->
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <Link
                                href="/"
                                class="text-gray-900 dark:text-white inline-flex items-center px-1 pt-1 border-b-2 border-indigo-500 text-sm font-medium"
                            >
                                Home
                            </Link>
                            <Link
                                href="#"
                                class="text-gray-900 dark:text-white inline-flex items-center px-1 pt-1 text-sm font-medium"
                            >
                                Products
                            </Link>
                            <Link
                                href="#"
                                class="text-gray-900 dark:text-white inline-flex items-center px-1 pt-1 text-sm font-medium"
                            >
                                About
                            </Link>
                            <Link
                                href="#"
                                class="text-gray-900 dark:text-white inline-flex items-center px-1 pt-1 text-sm font-medium"
                            >
                                Contact
                            </Link>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div
                            v-if="canLogin"
                            class="hidden sm:flex sm:items-center sm:ml-6"
                        >
                            <Link
                                v-if="$page.props.auth.user"
                                :href="route('dashboard')"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                >Dashboard</Link
                            >

                            <template v-else>
                                <Link
                                    :href="route('login')"
                                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                    >Log in</Link
                                >

                                <Link
                                    v-if="canRegister"
                                    :href="route('register')"
                                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                    >Register</Link
                                >
                            </template>
                        </div>
                                               <!-- Mobile menu button -->
                        <div class="sm:hidden">
                            <button @click="toggleMobileMenu" class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path v-if="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile menu -->
            <div v-show="mobileMenuOpen" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <Link
                        href="/"
                        class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                    >
                        Home
                    </Link>
                    <Link
                        href="#"
                        class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                    >
                        Products
                    </Link>
                    <Link
                        href="#"
                        class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                    >
                        About
                    </Link>
                    <Link
                        href="#"
                        class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                    >
                        Contact
                    </Link>
                </div>
                <div v-if="canLogin" class="pt-4 pb-3 border-t border-gray-200">
                    <div class="space-y-1">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                        >
                            Dashboard
                        </Link>
                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                            >
                                Log in
                            </Link>
                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                            >
                                Register
                            </Link>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="bg-green-500 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold mb-4">Welcome to Our Store</h1>
                <p class="text-xl mb-8">
                    Discover amazing products at great prices
                </p>
                <button
                    class="bg-white text-green-500 px-6 py-2 rounded-full font-semibold hover:bg-green-100 transition-colors duration-200"
                >
                    Shop Now
                </button>
            </div>
        </div>

        <!-- Product Section -->
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">
                Featured Products
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden"
                >
                    <img
                        :src="product.image"
                        :alt="product.name"
                        class="w-full h-48 object-cover"
                    />
                    <div class="p-4">
                        <h3
                            class="text-xl font-semibold text-gray-900 dark:text-white mb-2"
                        >
                            {{ product.name }}
                        </h3>
                        <button
                            class="w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors duration-200"
                        >
                            Shop Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
