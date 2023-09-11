<script setup>
import AuthenticatedLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { toRefs, computed } from 'vue';

import {useCartStore} from '@/store/Cart'
import {storeToRefs} from 'pinia';
const cartStore = useCartStore()
const { cart } = storeToRefs(cartStore)

// Compute the total price of items in the cart
const total = computed(() => {
    let total = 0;

    // Calculate the total by iterating through cart items
    cart.value.forEach(item => {
        total += item.price;
    });

    // Ensure the total is formatted with 2 decimal places
    if (total > 0) {
        return total.toFixed(2);
    }

    // Return 0 if the total is not greater than 0
    return 0;
});

</script>

<template>
   <!-- Set the page title -->
   <Head title="Checkout" />

    <!-- Include the AuthenticatedLayout component -->
    <AuthenticatedLayout>
        <div class="p-4 mt-2 mx-auto font-extrabold flex gap-4">
            <div class="w-8/12">
                <div class="w-full bg-white p-4 mt-4">
                    
                    <!-- Shipping Details Section -->
                    <div class="font-roboto font-semibold mt-4 border-b">
                        Shipping Details
                    </div>

                    <!-- Check if user's address information is available -->
                    <div v-if="$page.props.auth.address" class="w-[300px] mt-4">
                        
                        <!-- Recipient Name -->
                        <div class="flex justify-between gap-6 border-dotted border-b-2">
                            <div class="w-1/2">Recipient Name:</div>
                            <div class="font-light w-1/2">
                                <div>{{ $page.props.auth.user.name }}</div>
                            </div>
                        </div>

                        <!-- Street Address -->
                        <div class="flex justify-between gap-6 border-dotted border-b-2">
                            <div class="w-1/2">Street:</div>
                            <div class="font-light w-1/2">
                                <div>{{ $page.props.auth.address.addr1 }}</div>
                                <div>{{ $page.props.auth.address.addr2 }}</div>
                            </div>
                        </div>
                        
                        <!-- City -->
                        <div class="flex justify-between gap-6 border-dotted border-b-2">
                            <div class="w-1/2">City:</div>
                            <div class="font-light w-1/2">{{ $page.props.auth.address.city }}</div>
                        </div>
                        
                        <!-- Post Code -->
                        <div class="flex justify-between gap-6 border-dotted border-b-2">
                            <div class="w-1/2">Post Code:</div>
                            <div class="font-light w-1/2">{{ $page.props.auth.address.postcode }}</div>
                        </div>
                        
                        <!-- Country -->
                        <div class="flex justify-between gap-6 border-dotted border-b-2">
                            <div class="w-1/2">Country:</div>
                            <div class="font-light w-1/2">{{ $page.props.auth.address.country }}</div> 
                        </div>
                    </div>

                     <!-- Order Details Section -->
                    <div class="font-roboto font-semibold mt-10 border-b">
                        Order Details
                    </div>

                    <!-- Loop through products in cart -->
                    <div class="flex border-b justify-between pr-10" v-for="product in cart" :key="product">

                        <!-- Product Information -->
                        <div class="flex items-center gap-4">
                            <img class="h-[180px] mt-4 mb-4" :src="product.image" alt="">
                            <div class="text-gray-900 pb-2 -mt-4 font-bold text-[18px] hover:text-[#972A3E] hover:underline">{{ product.title }}</div>
                        </div>

                        <!-- Price Information -->
                        <div class="flex gap-2">
                            <div class="py-10 justify-end">
                                <div class="font-bold pl-20">£{{ product.price }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Section -->
            <div class="bg-white w-[450px] p-4 mt-4 h-48">
                <div class="font-roboto font-semibold mt-4">Summary</div>
                <div class="border-[1px] p-4 rounded-sm shadow-[rgba(0,_0,_0,_0.24)_0px_0px_2px]">
                    <div class="border-b">
                        <div>Order totals</div>
                    </div>
                    <div class="flex justify-between">
                        <div class="font-extrabold text-[18px] pt-4">
                        Subtotal
                        </div>
                        <div class="font-extrabold text-[18px] pt-4">£{{ total }}</div>
                    </div>

                    <!-- Secure Order Button -->
                    <div class="w-full flex justify-center mt-5">
                        <Link 
                            method="post"
                            :href="$page.props.auth.user !== null
                                ? route('checkout.store', {
                                    total: total,
                                    items: cart
                                })
                                : route('login')
                            " 
                            class="border-[1px] hover:bg-[#9f3f52] rounded-sm border-[#80041c] p-1 px-3 bg-[#80041c] text-white font-bold cursor-pointer">
                                Secure Order
                        </Link>
                    </div>
                </div>

                <!-- Back to Cart Link -->
                <Link :href="route('cart.index')" class="flex text-[13px] hover:text-gray-400 underline text-gray-500 mt-4">Back to cart</Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
