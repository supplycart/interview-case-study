<script setup>
import AuthenticatedLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { toRefs, computed } from 'vue';
import VueNumericInput from '@/Components/VueNumericInput.vue';

import {useCartStore} from '@/store/cart'
import {storeToRefs} from 'pinia';
const cartStore = useCartStore()
const { cart } = storeToRefs(cartStore)

const props = defineProps({product: Object});
const { product } = toRefs(props)

const addToCart = (product) => {
    cart.value.push(product)
}

const isAlreadyInCart = computed(() => {
    let res = cart.value.find(c => c.id === product.value.id)
    if (res) return true
    return false
})
</script>

<template>
    <Head title="Product" />

    <AuthenticatedLayout>
        <div class="p-3 font-bold font-roboto text-[15px] text-gray-600">{{ $page.props.category_name }} / {{ product.title }} /</div>
        <div class="flex w-full justify-between px-20">
            <div class="pt-10">
                <div class="flex w-[500px]">
                    <img :src="product.image" alt="w-auto">
                </div>
            </div>
            
            <div class="pt-10 w-[400px]">
                <div class="text-[30px]">{{ product.title }}</div>
                <div class="mt-10">{{ product.description }}</div>
                <div class="text-[24px] mt-6">£{{ product.price }}</div>
                
                <div v-if="isAlreadyInCart" class="
                        w-full
                        mt-6
                        border-[1px] 
                        border-gray-800 
                        p-2
                        rounded-sm
                        text-center
                        text-[18px] 
                        font-roboto 
                        bg-gray-300
                        ">
                        Already in Basket
                </div>

                <div v-else 
                    @click="addToCart(product)"
                    class="
                        w-full
                        mt-6
                        border-[1px] 
                        border-[#80041c] 
                        p-2
                        rounded-sm
                        text-center
                        text-[18px] 
                        font-roboto 
                        bg-[#80041c] 
                        text-white 
                        cursor-pointer
                        hover:shadow-[rgba(0,_0,_0,_0.74)_0px_0px_8px]">
                        Add to Basket
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
