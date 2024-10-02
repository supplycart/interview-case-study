<template>
    <div class="rounded-lg border border-gray-200 bg-white shadow-sm p-3">
        <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
            <a href="#" class="shrink-0 md:order-1">
                <img class="h-20 w-20" :src="product.image.url" alt="imac image" />
            </a>

            <label for="counter-input" class="sr-only">Choose quantity:</label>
            <div class="flex items-center justify-between md:order-3 md:justify-end">
                <div class="flex items-center">
                    <button @click="updateItemInCart(product.id, -1)" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100">
                        <svg class="h-2.5 w-2.5 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                        </svg>
                    </button>
                    <input type="text" id="counter-input" data-input-counter class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0" placeholder="" :value="props.cartItem.quantity" required />
                    <button @click="updateItemInCart(product.id, 1)" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100">
                        <svg class="h-2.5 w-2.5 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                        </svg>
                    </button>
                </div>
                <div class="text-end md:order-4 md:w-32">
                    <p class="text-base font-bold text-gray-900">{{ product.currency }} {{ product.price }}</p>
                </div>
            </div>

            <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                <a href="#" class="text-base font-medium text-gray-900 hover:underline">{{ product.name }}</a>

                <div class="flex items-center gap-4">
                    <button @click="removeItemFromCart(product.id)" class="inline-flex items-center text-sm font-medium text-red-600 hover:underline">
                        <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                        Remove
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed} from "vue";
import {router} from "@inertiajs/vue3";
import {cartCounterStore} from "@/cartCounter.js";

const counter = cartCounterStore();

const props = defineProps({
    cartItem: Object
})

const product = computed(() => {
    return props.cartItem.product;
})

function updateItemInCart(productId, quantity) {
    axios({
        method: 'post',
        url: route('cart.store'),
        data: {
            product_id: productId,
            quantity: quantity
        }
    })
        .then(() => {
            router.reload({
                only: ['cartItems'],
                preserveScroll: true,
                preserveState: true
            })

            quantity === 1 ? counter.increment() : counter.decrement();
        })
}

function removeItemFromCart(productId) {
    axios({
        method: 'delete',
        url: route('cart.destroy', productId)
    })
        .then(() => {
            router.reload({
                only: ['cartItems'],
                preserveScroll: true,
                preserveState: true
            })
            counter.decrementBy(props.cartItem.quantity);
        })
}
</script>
