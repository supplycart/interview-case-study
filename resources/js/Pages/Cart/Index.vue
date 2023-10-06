<template>
    <Head title="Cart"></Head>
    <AuthenticatedLayout>
        <section class="h-screen bg-gray-100 sm:py-16 lg:py-5">
            <div class="flex items-end space-x-3">
                <Link :href="route('dashboard')" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center hover:underline"> &#x2190; Back</Link>
            </div>
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <h1 class="text-2xl font-semibold text-gray-900">My Cart</h1>
                </div>

                <div class="mx-auto mt-8 max-w-2xl md:mt-12">
                    <div class="bg-white shadow">
                        <div class="px-4 py-6 sm:px-8 sm:py-10">
                            <div class="flow-root">
                                <ul class="-my-8">
                                    <li v-for="(cart, index) in carts" :key="index" class="flex flex-col space-y-3 py-6 text-left sm:flex-row sm:space-x-5 sm:space-y-0">
                                        <div class="shrink-0" v-if="cart.product.image">
                                            <img class="h-24 w-24 max-w-full rounded-lg object-cover" :src="cart.product.image" alt="" />
                                        </div>
                                        <div class="shrink-0" v-else>
                                            <img class="h-24 w-24 max-w-full rounded-lg object-cover" src="images/no-image.webp" alt="" />
                                        </div>

                                        <div class="relative flex flex-1 flex-col justify-between">
                                            <div class="sm:col-gap-5 sm:grid sm:grid-cols-2">
                                            <div class="pr-8 sm:pr-5">
                                                <p class="text-base font-semibold text-gray-900">{{ cart.product.name }}</p>
                                            </div>

                                            <div class="mt-4 flex items-end justify-between sm:mt-0 sm:items-start sm:justify-end">
                                                <p class="shrink-0 w-20 text-base font-semibold text-gray-900 sm:order-2 sm:ml-8 sm:text-right">$ {{ cart.product.price }}</p>

                                                <div class="sm:order-1">
                                                    <div class="mx-auto flex h-8 items-stretch text-gray-600">
                                                        <button class="flex items-center justify-center rounded-l-md bg-gray-200 px-4 transition hover:bg-black hover:text-white">-</button>
                                                        <div class="flex w-full items-center justify-center bg-gray-100 px-4 text-xs uppercase transition">{{ cart.quantity }}</div>
                                                            <button class="flex items-center justify-center rounded-r-md bg-gray-200 px-4 transition hover:bg-black hover:text-white">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="absolute top-0 right-0 flex sm:bottom-0 sm:top-auto">
                                                <button type="button" class="flex rounded p-2 text-center text-gray-500 transition-all duration-200 ease-in-out focus:shadow hover:text-gray-900">
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" class=""></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="mt-6 border-t border-b py-2">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-gray-400">Subtotal</p>
                                    <p class="text-2xl font-semibold text-gray-900">
                                        <span class="text-xs font-normal text-gray-400">MYR</span> {{ totalAmount.toFixed(2) }}
                                    </p>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-gray-400">Shipping</p>
                                    <p class="text-lg font-semibold text-gray-900">$0.00</p>
                                </div>
                            </div>
                            <div class="mt-6 flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900">Total</p>
                                <p class="text-2xl font-semibold text-gray-900">
                                    <span class="text-xs font-normal text-gray-400">MYR</span>
                                    {{ totalAmount.toFixed(2) }}
                                </p>
                            </div>

                            <div class="mt-6 text-center">
                                <Link :href="route('orders.store')" method="post" class="group inline-flex w-full items-center justify-center rounded-md bg-gray-900 px-6 py-4 text-lg font-semibold text-white transition-all duration-200 ease-in-out focus:shadow hover:bg-gray-800">
                                    Checkout
                                    <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:ml-8 ml-4 h-6 w-6 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, defineProps, watch, onMounted } from 'vue';

const props = defineProps({
    carts: Object,
});

const carts = props.carts;

const totalAmount = ref(0);

watch(() => props.carts, () => {
    calculateTotalAmount();
});

onMounted(() => {
    calculateTotalAmount();
});

const calculateTotalAmount = () => {
    totalAmount.value = props.carts.reduce((total, cart) => {
        return total + cart.product.price * cart.quantity;
    }, 0);
};
</script>
