<template>
    <Head title="Product"></Head>
    <AuthenticatedLayout>
        <div class="flex space-x-3">
            <Link :href="route('dashboard')" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center hover:underline"> &#x2190; Back</Link>
        </div>
        <div class="mt-10 flex flex-col items-center justify-center space-y-4 py-4 mx-10 sm:flex-row sm:space-y-0 md:justify-center lg:px-0">
            <div class="max-w-lg">
                <h1 class="text-5xl font-bold text-gray-800 text-center">Products</h1>
                <p class="mt-2 text-gray-600 text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Explicabo, alias. Quas necessitatibus exercitationem praesentium.</p>
            </div>
        </div>

        <section>
            <div class="p-2">
                <div class="grid grid-cols-2 gap-x-4 gap-y-16 px-2 pb-20 sm:grid-cols-3 sm:px-8 lg:mt-16 lg:grid-cols-4 lg:gap-x-4 lg:px-0">
                    <article class="relative" v-for="(product, index) in products" :key="index">
                        <Link :href="'/products/' + product.id">
                            <div class="aspect-square overflow-hidden">
                                <div class="" v-if="product.image">
                                    <img class="h-full w-full object-cover transition-all duration-300 group-hover:scale-125" :src="product.image" alt="" />
                                </div>
                                <div class="" v-else>
                                    <img class="h-full w-full object-cover transition-all duration-300 group-hover:scale-125" src="/images/no-image.webp" alt="" />
                                </div>
                            </div>
                            <div class="absolute top-0 m-3 rounded-full bg-white">
                                <p class="rounded-full bg-black p-1 text-[10px] font-bold uppercase tracking-wide text-white sm:py-1 sm:px-3">Sale</p>
                            </div>
                            <div class="mt-4 flex items-start justify-between">
                                    <h3 class="text-xs font-semibold sm:text-sm md:text-base">
                                        <div href="#" title="" class="">
                                            {{ product.name }}
                                            <span class="absolute" aria-hidden="true"></span>
                                        </div>
                                    </h3>

                                <div class="text-right">
                                    <!-- <del class="mt-px text-xs font-semibold text-gray-600 sm:text-sm"> $79.00 </del> -->
                                    <p class="text-xs font-normal sm:text-sm md:text-base">{{ product.price }}</p>
                                </div>
                            </div>
                        </Link>

                    </article>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    products: Object,
});

const products = props.products;
</script>
