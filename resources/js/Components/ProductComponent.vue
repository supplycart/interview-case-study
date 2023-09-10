<script setup>

import { Link } from '@inertiajs/vue3';
import { toRefs } from 'vue';

const props = defineProps({product: Object});
const { product } = toRefs(props)
</script>

<template>
    <div class=" text-center gap-4 mx-auto">
        <div class="p-2 bg-white hover:shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px]">
            <Link :href="route('product.index', {id: product.id})" class="w-full">
                <div class="flex">
                    <img :src="product.image" alt="" class="w-auto">
                </div>
                                        
                <div class="font-roboto text-[18px] hover:text-[#972A3E] py-4">
                    {{ product.title }}
                </div>
                <div class="font-roboto text-[18px]">£{{ product.price }}</div>
            </Link>
            
        </div>
    </div>
</template>

