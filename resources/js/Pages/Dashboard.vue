<script setup>
import AuthenticatedLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Navigation, Slide , Pagination} from 'vue3-carousel'
import ProductComponent from '@/Components/ProductComponent.vue';

// Define an array of slides with titles and IDs
const slides = [
  { id: '1', title: ''},
  { id: '2', title: '20% off Mix & Match'},
  { id: '3', title: 'Polypropylene Storage'},
  { id: '4', title: 'Back to School'},
  { id: '5', title: 'MUJI Fragrance Collection'},
  { id: '6', title: 'Pyjamas'},
  { id: '7', title: 'MUJI Recipes'},
  { id: '8', title: 'Fans'},
]

// Define breakpoints for responsive carousel behavior
const breakpoints = {
  1500: {
    itemsToShow: 4,
    snapAlign: 'left',
  },

  1000: {
    itemsToShow: 3.5,
    snapAlign: 'left',
  },

  800: {
    itemsToShow: 2.5,
    snapAlign: 'left',
  },

  0: {
    itemsToShow: 2.5,
    snapAlign: 'left',
  }
}
</script>

<template>
    <!-- Set the title of the page -->
    <Head title="Dashboard" />

    <!-- Use the AuthenticatedLayout component for the authenticated user -->
    <AuthenticatedLayout>

        <!-- First Carousel for featured items -->
        <Carousel :autoplay="2000" :wrap-around="true">
            <!-- Loop through slides -->
            <Slide v-for="slide in 4" :key="slide">
                <div class="carousel__item p-20 cursor-pointer">
                    <!-- Display images in the carousel -->
                    <img id="slider" :src="`Images/carousel/1/slide${slide}.jpg`" alt="">
                </div>
            </Slide>

            <!-- Add navigation and pagination to the carousel -->
            <template #addons>
            <Pagination />
            <Navigation />
            </template>
        </Carousel>

        <!-- Second Carousel for categories -->
        <Carousel :wrap-around="true" :breakpoints="breakpoints">
            <!-- Loop through slides with category information -->
            <Slide v-for="slide in slides" :key="slide.id">
                <div class="carousel__item py-20 px-3">
                    <div class="bg-white align-items-center">
                        <div class="flex aspect-[254/190] cursor-pointer relative justify-center">
                            <!-- Display images related to each category -->
                            <img id="slider" :src="`Images/carousel/2/slide${slide.id}.jpg`" alt="" class="w-auto">
                            <!-- Display the title of the category if available -->
                            <div v-if="slide.title" class="absolute  bottom-0 bg-white rounded-t-lg z-10 p-2 pb-0">
                                {{ slide.title }}
                            </div>
                        </div>
                    </div>
                </div>
            </Slide>

            <!-- Add navigation and pagination to the carousel -->
            <template #addons>
                <div class="flex justify-center align-items-center mt-[20px]">
                    <Navigation />
                    <Pagination />
                </div>
            </template>
        </Carousel>

        <!-- Title for the newest products section -->
        <div class="text-center font-roboto font-bold text-[30px] p-20">Our Newest Products</div>

        <!-- Carousel to display the newest products -->
        <Carousel :wrap-around="true" :breakpoints="breakpoints">
            <!-- Loop through the random products -->
            <Slide v-for="product in $page.props.random_products" :key="product.id">
                <div class="carousel__item pb-10 px-3">
                    <!-- Link to the product details page -->
                    <Link :href="route('product.index', {id: product.id})" class="bg-white p-2 align-items-center hover:shadow-[rgba(0,_0,_0,_0.24)_0px_0px_14px]">
                        <div class="flex cursor-pointer">
                            <!-- Display the product image -->
                            <img :src="product.image" alt="" class="w-auto">
                        </div>
                        <div class="py-3 -mb-2 font-roboto font-bold hover:underline hover:text-[#972A3E] cursor-pointer text-[16px]">
                            <!-- Display the product title -->
                            {{ product.title }}
                        </div>
                    </Link>
                </div>
            </Slide>

            <!-- Add navigation and pagination to the carousel -->
            <template #addons>
                <div class="flex justify-center align-items-center mt-[20px]">
                <Navigation />
                <Pagination />
                </div>
            </template>
        </Carousel>

        <!-- Garments and Accessories section -->
        <div class="max-w-[1350px] lg:w-[75vw] md:w-screen mx-auto">
            <!-- Title for the Garments and Accessories section -->
            <div class="flex font-roboto font-bold text-[30px]">Garments and Accessories</div>
            <div class="flex justify-center items-stretch max-width-[250px]">
                <!-- Links to different categories -->
                <div class="p-4 mx-auto cursor-pointer">
                    <Link :href="route('category.index', {id: 3})">
                        <!-- Display the category image -->
                        <div class="aspect-[9/16] overflow-hidden rounded-lg bg-white hover:shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px]">
                            <img src="/images/categories/1.jpg" alt="" class="p-3 object-cover w-full h-full">
                        </div>
                    </Link>
                </div>

                <div class="p-4 mx-auto cursor-pointer">
                    <Link :href="route('category.index', {id: 4})">
                        <div class="aspect-[9/16] overflow-hidden rounded-lg bg-white hover:shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px]">
                            <img src="/images/categories/2.jpg" alt="" class="p-3 object-cover w-full h-full">
                        </div>
                    </Link>
                </div>

                <div class="p-4 mx-auto cursor-pointer">
                    <Link :href="route('category.index', {id: 5})">
                        <div class="aspect-[9/16] overflow-hidden rounded-lg bg-white hover:shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px]">
                            <img src="/images/categories/3.jpg" alt="" class="p-3 object-cover w-full h-full">
                        </div>
                    </Link>
                </div>

                <div class="p-4 mx-auto cursor-pointer">
                    <Link :href="route('category.index', {id: 7})">
                        <div class="aspect-[9/16] overflow-hidden rounded-lg bg-white hover:shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px]">
                            <img src="/images/categories/4.jpg" alt="" class="p-3 object-cover w-full h-full">
                        </div>
                    </Link>
                </div>
            </div> 
        </div>
        
            

        <!-- Furniture offers section -->
        <div class="max-w-[1500px] lg:w-[75vw] md:w-screen mx-auto pt-10">
            <div class="flex mt-6 gap-8 justify-between">
                <!-- Image for furniture offers -->
                <img src="https://img.muji.eu/img/ban/idx/UK_2023_04_04_14_40_32.jpg" alt="" class="w-[25vw]">

                <div class="max-w-[48vw]">
                    <!-- Title for furniture offers section -->
                    <div class="flex font-roboto font-bold text-[30px]">Furniture offers</div>
                    <div class="flex justify-between items-center">
                        <div class="text-center gap-4 mx-auto flex">
                            <!-- Loop through random furniture products -->
                            <div v-for="product in $page.props.random_furniture" :key="product.id">
                                <ProductComponent :product="product" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- "See More" link for furniture offers -->
        <div class="max-w-[1500px] lg:w-[75vw] md:w-screen mx-auto pt-5">
            <div class="flex justify-end">
                <Link :href="route('category.index', {id: 1})" class="bg-white border-[1px] border-gray-400 p-2 rounded-3xl text-[18px] hover:shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px] hover:underline hover:text-[#972A3E]">
                    See More
                </Link>
            </div>
        </div>

        <!-- Autumn Garments section -->
        <div class="max-w-[1500px] lg:w-[75vw] md:w-screen mx-auto pt-10">
            <div class="flex mt-6 gap-8 justify-between">
                <div class="max-w-[48vw]">
                    <!-- Title for Autumn Garments section -->
                    <div class="flex font-roboto font-bold text-[30px] justify-end">Autumn Garments</div>
                    <div class="flex justify-between items-center gap-4">
                        <div class="text-center gap-4 mx-auto flex">
                            <!-- Loop through random men's products -->
                            <div v-for="product in $page.props.random_men" :key="product.id">
                                <ProductComponent :product="product" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Image for Autumn Garments -->
                <img src="https://img.muji.eu/img/ban/idx/UK_2023_09_01_10_20_19.jpg" alt="" class="w-[25vw]">
            </div>
        </div>

        <!-- "See More" link for Autumn Garments -->
        <div class="max-w-[1500px] lg:w-[75vw] md:w-screen mx-auto pt-5">
            <div class="flex justify-end">
                <Link :href="route('category.index', {id: 4})" class="bg-white border-[1px] border-gray-400 p-2 rounded-3xl text-[18px] hover:shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px] hover:underline hover:text-[#972A3E]">
                    See More
                </Link>
            </div>
        </div>
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
    color: rgb(181,182,186);
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

.carousel__pagination-button::after {
  width: 10px; 
  height: 10px; 
  border-radius: 50%; 
}

</style>
