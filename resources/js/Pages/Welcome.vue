<script setup>
import { Head, Link } from '@inertiajs/vue3';

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
</script>

<template>
    <Head title="Product" />
    <nav class="sticky top-0 z-50 w-full">
        <div class="sm:fixed sm:top-0 sm:left-0 p-6 text-left w-full bg-white border-b-4 border-b-indigo-500">
            <h1 class="font-bold uppercase text-xl">Ecommerce</h1>
        </div>
    </nav>
    <section class="mx-10 mt-32 sm:mt-20 lg:mt-36">
        <div class="flex items-center justify-center ">
            <!-- Left column container with background-->
            <div class="g-6 flex h-1/2 w-3/4 flex-wrap items-center justify-center lg:justify-between">
                <Link v-if="canLogin" :href="route('login')" class="shrink-1 mb-12 grow-0 basis-auto mb-12 md:mb-0 md:w-3/5 lg:w-5/12 xl:w-5/12 mx-4">
                    <img src="/images/login.png" class="w-full" alt="login logo" />
                    <h1 class="font-bold uppercase text-xl text-center hover:underline">Login</h1>
                </Link>

                <!-- Right column container -->
                <Link v-if="canRegister" :href="route('register')" class="mb-12 md:mb-0 md:w-3/5 lg:w-5/12 xl:w-5/12 mx-4">
                    <img src="/images/register.png" class="w-full" alt="register logo" />
                    <h1 class="font-bold uppercase text-xl text-center hover:underline">register</h1>
                </Link>
            </div>
        </div>
    </section>
    <!-- <section>
        <div class="p-2 mt-14">
            <h1 class="text-center text-2xl font-bold">Product</h1>
            <div class="grid grid-cols-2 gap-x-6 gap-y-10 px-2 pb-20 sm:grid-cols-3 sm:px-8 lg:mt-16 lg:grid-cols-4 lg:gap-x-4 lg:px-0">
                <article class="relative">
                    <div class="aspect-square overflow-hidden">
                        <img class="h-full w-full object-cover transition-all duration-300 group-hover:scale-125" src="/images/cargo-pants.png" alt="" />
                    </div>
                    <div class="absolute top-0 m-1 rounded-full bg-white">
                        <p class="rounded-full bg-black p-1 text-[10px] font-bold uppercase tracking-wide text-white sm:py-1 sm:px-3">Sale</p>
                    </div>
                    <div class="mt-4 flex items-start justify-between">
                        <div class="">
                            <h3 class="text-xs font-semibold sm:text-sm md:text-base">
                                <a href="#" title="" class="">
                                Arabian Musk
                                <span class="absolute" aria-hidden="true"></span>
                                </a>
                            </h3>
                            <div class="mt-2 flex items-center">
                                <svg class="block h-3 w-3 align-middle text-pink-600 sm:h-4 sm:w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" class=""></path>
                                </svg>
                                <svg class="block h-3 w-3 align-middle text-pink-600 sm:h-4 sm:w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" class=""></path>
                                </svg>
                                <svg class="block h-3 w-3 align-middle text-pink-600 sm:h-4 sm:w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" class=""></path>
                                </svg>
                                <svg class="block h-3 w-3 align-middle text-pink-600 sm:h-4 sm:w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" class=""></path>
                                </svg>
                                <svg class="block h-3 w-3 align-middle text-gray-400 sm:h-4 sm:w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" class=""></path>
                                </svg>
                            </div>
                        </div>

                        <div class="text-right">
                            <del class="mt-px text-xs font-semibold text-gray-600 sm:text-sm"> $79.00 </del>
                            <p class="text-xs font-normal sm:text-sm md:text-base">$99.00</p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section> -->
</template>


