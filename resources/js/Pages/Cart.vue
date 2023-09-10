<script setup>
import AuthenticatedLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { toRefs, computed } from 'vue';

import {useCartStore} from '@/store/cart'
import {storeToRefs} from 'pinia';
const cartStore = useCartStore()
const { cart } = storeToRefs(cartStore)

const removeFromCart = (id) => {
    cartStore.removeProductFromCart(id)
}

const total = computed(() => {
    let total = 0
    cart.value.forEach(c => {
        total += c.price
    })
    if (total > 0) {
        return total.toFixed(2)
    }
    return 0
})
</script>

<template>
    <Head title="Cart" />

    <AuthenticatedLayout>

        <div v-if="!cart.length" class="text-center font-bold py-20 font-roboto text-[15px]">
                    Your Shopping Cart is Empty
        </div>

        <div v-else class="flex gap-4">
            <div class="w-full bg-white p-4 mt-4">
                <div class="font-roboto font-semibold">Shopping Basket</div>
                <div class="border-b flex justify-between pr-20 mt-10">
                    <div>Product</div>
                    <div>Price</div>
                </div>

                

                <div class="flex border-b justify-between pr-10" v-for="product in cart" :key="product">

                    <div class="flex items-center gap-4">
                        <img class="h-[180px] mt-4 mb-4" :src="product.image" alt="">
                    
                        <div class="text-gray-900 pb-2 -mt-4 font-bold text-[18px] hover:text-[#972A3E] hover:underline">{{ product.title }}</div>
                        
                    </div>
                    
                    <div class="flex gap-2">
                        <div class="py-10 justify-end">
                            <div class="font-bold pl-20">£{{ product.price }}</div>
                        </div>

                        <div @click="removeFromCart(product.id)">
                            <img src="/images/icon/close.png" alt="" class="hover:shadow-[rgba(0,_0,_0,_0.24)_0px_0px_2px] cursor-pointer">
                        </div>
                    </div>

                    
                </div>
            </div>

            <div class="bg-white w-[450px] p-4 mt-4 h-48">
                <div class="font-roboto font-semibold">Summary</div>
                <div class="border-[1px] p-4 rounded-sm shadow-[rgba(0,_0,_0,_0.24)_0px_0px_2px] mt-10">
                    <div class="border-b">
                        <div>Order totals</div>
                    </div>
                    <div class="flex justify-between">
                        <div class="font-extrabold text-[18px] pt-4">
                        Subtotal
                        </div>
                        <div class="font-extrabold text-[18px] pt-4">£{{ total }}</div>
                    </div>

                    <div class="w-full flex justify-center mt-5">
                        <Link class="border-[1px] hover:bg-[#9f3f52] rounded-sm border-[#80041c] p-1 px-3 bg-[#80041c] text-white font-bold cursor-pointer">
                            Secure Checkout
                        </Link>
                    </div>
                    
                </div>
                
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
