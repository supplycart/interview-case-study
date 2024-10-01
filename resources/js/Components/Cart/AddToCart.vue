<template>
    <button @click="addToCart(productId, quantity)" :disabled="addToCartButton.value"
            :class="addToCartButton.value ? ['bg-gray-300', 'cursor-not-allowed'] : ['bg-indigo-500', 'hover:bg-indigo-800']"
            class="w-full flex gap-2 items-center justify-center text-white focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center"
    >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
        </svg>
        {{ addToCartButton.text }}
    </button>

    <div class="text text-red-500" v-if="error.show"></div>
</template>

<script setup>
import {reactive} from "vue";

defineProps({
    productId: Number,
    quantity: {
        type: Number,
        default: 1
    }
})

const error = reactive({
    message: '',
    show: false
});

const addToCartButton = reactive({
    value: false,
    text: 'Add to cart'
});

function addToCart(productId, quantity) {
    error.message = '';
    error.show = false;

    addToCartButton.value = true;
    addToCartButton.text = 'Adding to cart...';

    axios({
        method: 'post',
        url: route('cart.store'),
        data: {
            product_id: productId,
            quantity: quantity
        }
    }).then(response => {
        console.log(response.data);
    }).catch(error => {
        error.message = error.response.data.message;
        error.show = true;
    }).finally(() => {
        addToCartButton.value = false;
        addToCartButton.text = 'Add to cart';
    });
}
</script>
