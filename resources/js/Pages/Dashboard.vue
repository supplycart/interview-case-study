<script setup>
import AuthenticatedLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Navigation, Slide , Pagination} from 'vue3-carousel'


const breakpoints = {
  0: {
    itemsToShow: 3.5,
    snapAlign: 'left',
  },
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <Carousel :autoplay="2000" :wrap-around="true">
            
            <Slide v-for="slide in 5" :key="slide">
                <div class="carousel__item p-20">
                    <img src="https://via.placeholder.com/1350x800.png/004466?text=Testing" alt="">
                </div>
            </Slide>

            <template #addons>
            <Pagination />
            <Navigation />
            </template>
        </Carousel>

        <Carousel :wrap-around="true" :breakpoints="breakpoints">
            <Slide v-for="slide in 10" :key="slide.id" class="p-5">
                <div class="carousel__item">
                    <div class="bg-gray-800 p-5 max-width-[380px] w-auto align-items-center">
                        <div class="flex">
                            <img src="https://via.placeholder.com/260x155.png" alt="">
                        </div>
                        <div class="pt-3 -mb-2 font-bold hover:underline hover:text-[#972A3E] cursor-pointer">
                            Cotton Blend Long Sleeve Cardigan
                        </div>
                    </div>
                </div>
            </Slide>

            <template #addons>
            <Navigation />
            <Pagination />
            </template>
        </Carousel>
    </AuthenticatedLayout>
</template>

<style>
.carousel__item {
    font-size: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.carousel__prev,
.carousel__next {
    width: 40px;
    height: 200px;
    color: transparent;
    justify-content: center;
    border: transparent;
}

.carousel__prev:hover,
.carousel__next:hover {
    transition: 1s;
    width: 40px;
    height: 200px;
    color: rgb(135, 135, 135);
    border: transparent;
}
</style>
