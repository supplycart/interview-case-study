<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';

const url = usePage().props.s3.url;
const props = defineProps({
    orders: {
        type: Array,
    },
});
</script>

<template>
    <Head title="Order" />

    <AuthenticatedLayout>
        <div class="2xl:container 2xl:mx-auto py-14 px-4 md:px-6 xl:px-20">
            <div class="flex flex-col xl:flex-row justify-center items-center space-y-10 xl:space-y-0 xl:space-x-8">
                <div class="w-full lg:w-9/12 xl:w-full">
                    <img class="w-full hidden xl:block" src="https://i.ibb.co/RcMmXKc/Rectangle-19.png" alt="wardrobe " />
                    <img class="w-full hidden md:block xl:hidden" src="https://i.ibb.co/ZhjHb0R/Rectangle-19-2.png" alt="wardrobe " />
                    <img class="w-full md:hidden" src="https://i.ibb.co/sbV9CD2/Rectangle-19.png" alt="wardrobe " />
                </div>
                <div class="flex justify-center flex-col items-start w-full lg:w-9/12 xl:w-full">
                    <div v-for="(order, index) in orders" :key="index" class="flex justify-center items-center w-full mt-8 flex-col space-y-4">
                        <h3 class="text-3xl xl:text-4xl dark:text-white font-semibold leading-7 xl:leading-9 w-full md:text-left text-gray-800">Order Summary</h3>
                        <div v-for="(item, index) in order.items" :key="index" class="flex md:flex-row justify-start items-start md:items-center border border-gray-200 w-full">
                            <div class="-m-px w-40 md:w-32">
                                <img class="hidden md:block" :src="url+item.product.image" alt="product-image" />
                                <img class="md:hidden" :src="url+item.product.image" alt="product-image" />
                            </div>
                            <div class="flex justify-start md:justify-between items-start md:items-center flex-col md:flex-row w-full p-4 md:px-8">
                                <div class="flex flex-col md:flex-shrink-0 justify-start items-start">
                                    <h3 class="text-lg md:text-xl dark:text-white w-full font-semibold leading-6 md:leading-5 text-gray-800">{{ item.product.name }}</h3>
                                    <div class="flex flex-row justify-start space-x-4 md:space-x-6 items-start mt-4">
                                        <p class="text-sm leading-none dark:text-gray-300 text-gray-600">Quantity: <span class="text-gray-800 dark:text-white"> {{ item.quantity }}</span></p>
                                    </div>
                                </div>
                                <div class="flex mt-4 md:mt-0 md:justify-end items-center w-full">
                                    <p class="text-xl dark:text-white lg:text-2xl font-semibold leading-5 lg:leading-6 text-gray-800">${{ item.product.price.toFixed(2) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col flex-col justify-start items-start mt-8 xl:mt-10 space-y-10 w-full">
                            <div class="flex flex-col w-full space-y-4 w-full">
                                <div class="flex justify-between items-center w-full">
                                    <p class="text-base dark:text-white font-semibold leading-4 text-gray-800">Total</p>
                                    <p class="text-base dark:text-gray-300 font-semibold leading-4 text-gray-600">${{ (order.total/100).toFixed(2) }}</p>
                                </div>
                                <div class="flex w-full justify-center items-center pt-1 md:pt-4 xl:pt-8 space-y-6 md:space-y-8 flex-col">
                                    <button class="py-5 dark:bg-white dark:text-gray-800 dark:hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 w-full text-base font-medium leading-4 text-white bg-gray-800 hover:bg-black">Track Your Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
