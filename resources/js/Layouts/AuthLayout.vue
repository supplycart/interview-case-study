<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <nav class="sticky top-0 z-50 w-full">
        <div class="sm:fixed sm:top-0 sm:left-0 p-6 text-left w-full bg-white border-b-4 border-b-indigo-500">
            <h1 class="font-bold uppercase text-xl">Ecommerce</h1>
        </div>
    </nav>
    <section class="h-screen">
        <div class="h-full">
            <!-- Left column container with background-->
            <div class="g-6 flex h-full flex-wrap items-center justify-center lg:justify-between">
                <div class="shrink-1 mb-12 mt-2 grow-0 basis-auto md:mb-0 md:w-9/12 md:shrink-0 lg:w-6/12 xl:w-6/12">
                    <img src="/images/ecommerce.avif" class="w-11/12 h-3/5" alt="homepage logo" />
                </div>

                <!-- Right column container -->
                <div class="mb-12 md:mb-0 md:w-8/12 lg:w-5/12 xl:w-5/12 mx-12">
                    <slot />
                </div>
            </div>
        </div>
    </section>
</template>
