<template>
    <div class="space-y-4 rounded-lg bg-white p-4 shadow-sm sm:p-6">
        <p class="text-xl font-semibold text-gray-900">Order summary</p>

        <div class="space-y-4">
            <div class="space-y-2">
                <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500">Original price</dt>
                    <dd class="text-base font-medium text-gray-900">{{ currency }} {{ originalPrice }}</dd>
                </dl>

                <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500">Savings</dt>
                    <dd class="text-base font-medium text-green-600">{{ currency }} {{ discount }}</dd>
                </dl>

                <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500">Shipping Fee</dt>
                    <dd class="text-base font-medium text-gray-900">{{ currency }} {{ shippingFee }}</dd>
                </dl>

                <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500">Tax</dt>
                    <dd class="text-base font-medium text-gray-900">{{ currency }} {{ parseFloat(totalTax).toFixed(2) }}</dd>
                </dl>
            </div>

            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2">
                <dt class="text-base font-bold text-gray-900">Total</dt>
                <dd class="text-base font-bold text-gray-900">{{ currency }} {{ totalPrice }}</dd>
            </dl>
        </div>

        <div v-show="proceedToCheckout.proceedState === false" class="grid grid-rows-2 gap-1">
            <button
                @click="proceedToCheckout.proceed()"
                :disabled="cartItems.length < 1"
                :class="[
                {'cursor-not-allowed hover:bg-gray-400' : cartItems.length < 1 || proceedToCheckout.isPaying},
                cartItems.length < 1 || proceedToCheckout.isPaying ? 'bg-gray-300' : 'bg-indigo-700' ,
               ]"
                class="flex w-full items-center justify-center rounded-lg px-5 py-2.5 text-sm font-medium text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300"
            >
                {{ proceedToCheckout.proceedToCheckoutCopy }}
            </button>

            <div class="flex items-center justify-center gap-2" v-show="proceedToCheckout.isPaying === false">
                <span class="text-sm font-normal text-gray-500"> or </span>
                <Link
                    :href="route('cart.index')"
                    @click="proceedToCheckout.backToCart()"
                    v-html="proceedToCheckout.continueShoppingCopy"
                    class="cursor-pointer inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import {Link, usePage} from '@inertiajs/vue3'
import {computed, ref} from "vue";
import {checkoutStore} from "@/checkoutStore.js";

const proceedToCheckout = checkoutStore();

const props = defineProps({
    cartItems: Array
})

const page = usePage();
const shippingFee = props.cartItems.length > 0
    ? parseFloat(page.props.settings.shipping_fee_price).toFixed(2)
    : "0.00";
const taxPercentage = parseFloat(page.props.settings.tax_percentage);
const totalTax = ref(0.00);

const originalPrice = computed(() => {
    const total = props.cartItems.reduce((total, item) => {
        return total + item.product.price * item.quantity;
    }, 0);

    return parseFloat(total).toFixed(2);
});

const discount = computed(() => {
    const total = props.cartItems.reduce((total, item) => {
        return total + item.product.discount_price * item.quantity;
    }, 0);

    return parseFloat(total).toFixed(2);
});

const currency = computed(() => {
    return props.cartItems.length > 0
        ? props.cartItems[0].product.currency
        : 'MYR';
});

const totalPrice = computed(() => {
    const totalWithoutTax = parseFloat(originalPrice.value) - parseFloat(discount.value);
    totalTax.value = parseFloat(totalWithoutTax * taxPercentage / 100);

    return  parseFloat(totalWithoutTax + totalTax.value + parseFloat(shippingFee)).toFixed(2);
});
</script>
