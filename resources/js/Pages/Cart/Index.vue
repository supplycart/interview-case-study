<template>
    <Head title="Shopping Carts"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Shopping Carts
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-flow-row-dense auto-rows-max md:grid-cols-4">
                    <div class="mx-2 md:col-span-3 row-span-1">
                        <div class="w-full overflow-hidden bg-white rounded-lg shadow-sm p-3 grid gap-y-4">
                            <EmptyCart v-if="props.cartItems.length === 0" />
                            <CartItems
                                v-for="cartItem in props.cartItems"
                                v-else-if="proceedToCheckout.proceedState === false"
                                :cart-item="cartItem"
                            />
                            <CheckoutForm v-else />
                        </div>
                    </div>
                    <div class="mx-2 md:my-0 my-2 md:col-span-1 row-span-1 bg-white rounded-lg md:bg-transparent">
                        <CartSummary :cart-items="cartItems" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import CartItems from "@/Pages/Cart/Partials/CartItems.vue";
import EmptyCart from "@/Pages/Cart/Partials/EmptyCart.vue";
import CartSummary from "@/Pages/Cart/Partials/CartSummary.vue";
import {checkoutStore} from "@/checkoutStore.js";
import CheckoutForm from "@/Pages/Cart/Partials/CheckoutForm.vue";

const props = defineProps({
    cartItems: Array
})

const proceedToCheckout = checkoutStore();
</script>
