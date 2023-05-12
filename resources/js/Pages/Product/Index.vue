<script setup>
import { onMounted, ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';

const url = usePage().props.s3.url;
const rows = ref(props.products);

const props = defineProps({
    products: {
        type: Object,
    },
});

const form = useForm({
    product: '',
});

onMounted(() => {
    if (!props.products) {
        rows.value = [
            { id: 1, name: 'Wilfred Alana Dress', image: 'https://i.ibb.co/HqmJYgW/gs-Kd-Pc-Iye-Gg.png', price: '150' },
            { id: 2, name: 'Wilfred Alana Dress', image: 'https://i.ibb.co/m6V0MzR/gs-Kd-Pc-Iye-Gg-1.png', price: '180' },
            { id: 3, name: 'Wilfred Alana Dress', image: 'https://i.ibb.co/6g1KhhF/pexels-django-li-2956641-1.png', price: '100' },
            { id: 4, name: 'Wilfred Alana Dress', image: 'https://i.ibb.co/KLDN7Vt/gbarkz-vq-Knu-G8-Ga-Qc-unsplash.png', price: '231' },
            { id: 5, name: 'Wilfred Alana Dress', image: 'https://i.ibb.co/5vxgf7V/pexels-quang-anh-ha-nguyen-884979-1.png', price: '133' },
            { id: 6, name: 'Wilfred Alana Dress', image: 'https://i.ibb.co/HKFXSrQ/pietra-schwarzler-l-SLq-x-Qd-FNI-unsplash.png', price: '200' },
            { id: 7, name: 'Wilfred Alana Dress', image: 'https://i.ibb.co/BKsqym2/tracey-hocking-ve-Zp-XKU71c-unsplash.png', price: '100' },
            { id: 8, name: 'Wilfred Alana Dress', image: 'https://i.ibb.co/mbrk1DK/pexels-h-i-nguy-n-4034532.png', price: '213' },
        ];
    }
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
            <p class="font-normal text-sm leading-3 text-gray-600 dark:text-white">Home</p>
            <hr class="w-full bg-gray-200 my-6" />

            <div class="grid lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 lg:gap-y-12 lg:gap-x-8 sm:gap-y-10 sm:gap-x-6 gap-y-6 lg:mt-12 mt-10">
                <div v-for="(row, index) in rows" :key="index" class="relative">
                    <div class="relative group">
                        <div class="flex justify-center items-center opacity-0 bg-gradient-to-t from-gray-800 via-gray-800 to-opacity-30 group-hover:opacity-50 absolute top-0 left-0 h-full w-full"></div>
                        <img class="w-full" :src="url+row.image" alt="A girl Posing Image" />
                        <div class="absolute bottom-0 p-8 w-full opacity-0 group-hover:opacity-100">
                            <button class="font-medium text-base leading-4 text-gray-800 bg-white py-3 w-full" @click="addToCart(row.id)">Add to cart</button>
                        </div>
                    </div>
                    <p class="font-normal text-xl leading-5 text-gray-800 dark:text-white md:mt-6 mt-4">{{ row.name }}</p>
                    <p class="font-semibold text-xl leading-5 text-gray-800 dark:text-white mt-4">${{ row.price.toFixed(2) }}</p>
                </div>
            </div>

            <hr class="w-full bg-gray-200 my-6" />

            <div class="flex justify-end items-center">
                <p class="cursor-pointer hover:underline duration-100 font-normal text-base leading-4 text-gray-600 dark:text-white">Showing {{ products.length }} products</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
