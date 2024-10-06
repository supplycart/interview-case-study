<template>
    <div class="w-full">
        <button @click="addToCart(productId, quantity)" :disabled="addToCartButton.value"
                :class="addToCartButton.value ? ['bg-gray-300', 'cursor-not-allowed'] : ['bg-indigo-500', 'hover:bg-indigo-800']"
                class="w-full flex gap-2 items-center justify-center text-white focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center"
        >
            <CartLogo/>
            {{ addToCartButton.text }}
        </button>

        <div class="my-3 text text-red-500" v-show="error.show">{{ error.message }}</div>
    </div>
</template>

<script setup>
import {reactive} from "vue";
import CartLogo from "@/Components/Cart/CartLogo.vue";
import {cartCounterStore} from "@/cartCounter.js";

const counter = cartCounterStore();

const props = defineProps({
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
    if (quantity < 1) {
        error.message = 'Quantity must be at least 1';
        error.show = true;

        return;
    }

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
        .then(() => {
            counter.incrementBy(quantity);
        })
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
