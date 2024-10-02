<template>
    <button @click="addToCart(productId, quantity)" :disabled="addToCartButton.value"
            :class="addToCartButton.value ? ['bg-gray-300', 'cursor-not-allowed'] : ['bg-indigo-500', 'hover:bg-indigo-800']"
            class="w-full flex gap-2 items-center justify-center text-white focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center"
    >
        <CartLogo/>
        {{ addToCartButton.text }}
    </button>

    <div class="text text-red-500" v-if="error.show"></div>
</template>

<script setup>
import {reactive} from "vue";
import CartLogo from "@/Components/Cart/CartLogo.vue";

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
    })
        .then(() => {})
        .catch(error => {
            error.message = error.response.data.message;
            error.show = true;
        })
        .finally(() => {
            addToCartButton.value = false;
            addToCartButton.text = 'Add to cart';
        });
}
</script>
