<script setup>
import { ref, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';

const url = usePage().props.s3.url;
const discount = usePage().props.auth.user.discount;

const props = defineProps({
    products: {
        type: Object,
    },
});

const form = useForm({
    product: '',
});

const filter = ref('all');

const filteredProducts = computed(() => {
    return props.products.filter(product => {
        if(filter.value == 'sale'){
            return product.is_on_sale == true;
        }else{
            return product;
        }
    });
});

const addToCart = (id) => {
    form.product = id;
    form.post(route('carts.store'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Products" />

    <AuthenticatedLayout>
        <div class="light:bg-gray-50 text-center lg:py-10 md:py-8 py-6">
            <p class="w-10/12 mx-auto md:w-full font-semibold lg:text-4xl text-3xl lg:leading-9 md:leading-7 leading-9 text-center text-gray-800 dark:text-white">Summer Collection</p>
        </div>
        <div class="light:bg-gray-50 py-6 lg:px-20 md:px-6 px-4">
        <div class="flex justify-between items-center">
            <p class="font-normal text-sm leading-3 text-gray-600 dark:text-white">Home</p>

            <select v-model="filter" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <option value="all">All</option>
                <option value="sale">On Sale</option>
            </select>
        </div>
            <hr class="w-full bg-gray-200 my-6" />

            <div class="grid lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 lg:gap-y-12 lg:gap-x-8 sm:gap-y-10 sm:gap-x-6 gap-y-6 lg:mt-12 mt-10">
                <div v-for="(product, index) in filteredProducts" :key="index" class="relative">
                    <div class="relative group">
                        <div class="flex justify-center items-center opacity-0 bg-gradient-to-t from-gray-800 via-gray-800 to-opacity-30 group-hover:opacity-50 absolute top-0 left-0 h-full w-full"></div>
                        <img class="w-full" :src="url+product.image" alt="A girl Posing Image" />
                        <div class="absolute bottom-0 p-8 w-full opacity-0 group-hover:opacity-100">
                            <button class="font-medium text-base leading-4 text-gray-800 bg-white py-3 w-full" @click="addToCart(product.id)">Add to cart</button>
                        </div>
                    </div>
                    <p class="font-normal text-xl leading-5 text-gray-800 dark:text-white md:mt-6 mt-4">{{ product.name }}</p>
                    <p class="font-semibold text-xl leading-5 text-gray-800 dark:text-white mt-4">${{ (product.price * ((discount) ? discount/100 : 1)).toFixed(2) }}</p>
                </div>
            </div>

            <hr class="w-full bg-gray-200 my-6" />

            <div class="flex justify-end items-center">
                <p class="cursor-pointer hover:underline duration-100 font-normal text-base leading-4 text-gray-600 dark:text-white">Showing {{ products.length }} products</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
