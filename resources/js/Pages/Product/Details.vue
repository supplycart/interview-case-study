<template>
    <Head title="Product Details"></Head>
    <AuthenticatedLayout>
        <div class="flex justify-end space-x-3">
            <Link :href="route('products.index')" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center hover:underline"> &#x2190; Back</Link>
        </div>
        <nav class="flex mt-3 text-xl mx-8">
            <ol role="list" class="flex items-start">
                <li class="text-left">
                    <div class="-m-1">
                        <a :href="route('dashboard')" class="rounded-md p-1 font-medium text-gray-600 focus:text-gray-900 focus:shadow hover:text-gray-800"> Home </a>
                    </div>
                </li>

                <li class="text-left">
                    <div class="flex items-center">
                        <span class="mx-2 text-gray-400">/</span>
                        <div class="-m-1">
                            <a :href="route('products.index')" class="rounded-md p-1 font-medium text-gray-600 focus:text-gray-900 focus:shadow hover:text-gray-800"> Products </a>
                        </div>
                    </div>
                </li>
                <li class="text-left">
                    <div class="flex items-center">
                        <span class="mx-2 text-gray-400">/</span>
                        <div class="-m-1">
                            <a href="#" class="rounded-md p-1 font-medium text-gray-600 focus:text-gray-900 focus:shadow hover:text-gray-800" aria-current="page"> {{ product.name }} </a>
                        </div>
                    </div>
                </li>
            </ol>
        </nav>

        <section>
            <div class="container mx-auto px-4">
                <div class="lg:col-gap-12 xl:col-gap-16 mt-4 grid grid-cols-1 gap-12 lg:mt-4 lg:grid-cols-5 lg:gap-16">
                    <div class="lg:col-span-3 lg:row-end-1">
                        <div class="max-w-xl overflow-hidden rounded-lg" v-if="product.image">
                            <img class="h-full w-full max-w-full object-cover" :src="product.image" alt="" />
                        </div>
                        <div class="max-w-xl overflow-hidden rounded-lg" v-else>
                            <img class="h-full w-full max-w-full object-cover" src="/images/no-image.webp" alt="" />
                        </div>
                    </div>

                    <div class="lg:col-span-2 lg:row-span-2 lg:row-end-2">
                        <h1 class="sm: text-2xl font-bold text-gray-900 sm:text-3xl">{{ product.name }}</h1>
                        <div class="flex items-end">
                            <h1 class="text-xl font-bold mt-2">$ {{ product.price }}</h1>
                        </div>

                        <h2 class="mt-8 text-base text-gray-900 font-bold text-lg">Brand</h2>
                        <div class="mt-2 flex select-none flex-wrap items-center">
                            {{ product.brand.name }}
                        </div>

                        <h2 class="mt-8 text-base text-gray-900 font-bold text-lg">Category</h2>
                        <div class="mt-2 flex select-none flex-wrap items-center">
                            {{ product.category.name }}
                        </div>

                        <h2 class="mt-8 text-base text-gray-900 font-bold text-lg">Description</h2>
                        <div class="mt-2 flex select-none flex-wrap items-center">
                            {{ product.description }}
                        </div>

                        <form @submit.prevent>
                            <Link @click="addToCart" :href="'/add-to-cart/' + product.id" class="mt-6 inline-flex items-center justify-center rounded-md border-2 border-transparent bg-gray-900 bg-none px-12 py-3 text-center text-base font-bold text-white transition-all duration-200 ease-in-out focus:shadow hover:bg-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                Add to cart
                            </Link>
                        </form>
                        <div v-if="successMessage" class="fixed top-0 right-0 bg-green-400 p-4 mt-16">
                            {{ successMessage }}
                        </div>

                        <ul class="mt-8 space-y-2">
                            <li class="flex items-center text-left text-sm font-medium text-gray-600">
                                <svg class="mr-2 block h-5 w-5 align-middle text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" class=""></path>
                                </svg>
                                Free shipping worldwide
                            </li>

                            <li class="flex items-center text-left text-sm font-medium text-gray-600">
                                <svg class="mr-2 block h-5 w-5 align-middle text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" class=""></path>
                                </svg>
                                Cancel Anytime
                            </li>
                        </ul>
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
    product: Object,
});

const product = props.product;

const successMessage = ref(null);

const addToCart = async () => {
    successMessage.value = 'Product added to cart successfully';

    setTimeout(() => {
        successMessage.value = '';
    }, 6000);
};
</script>
