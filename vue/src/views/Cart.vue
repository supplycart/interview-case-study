<template>
    <PageComponent title="Shopping Cart">
        <div v-if="cartItems.data.length">
            <form @submit.prevent="saveOrder" class="animate-fade-in-down">
            <div class="flex shadow-md my-10">
            <div class="w-3/4 bg-white px-10 py-10">
                <div class="flex justify-between border-b pb-8">
                <h2 class="font-semibold text-2xl">{{cartItems.data.length}} Items</h2>
                </div>
                <div class="flex mt-10 mb-5">
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
                <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
                </div>
                <CartListView
                    v-for="(cartItem,ind) in cartItems.data"
                    :key="cartItem.id"
                    :cartItem="cartItem"
                />
            </div>

            <div id="summary" class="w-1/4 px-8 py-10">
                <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
                <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                    <span>Total cost</span>
                    <span>${{totals}}.00</span>
                </div>
                <button type="submit" class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Checkout</button>
            </div>
            </div>
            </form>
        </div>
        <div v-else class="text-gray-600 text-center py-16">
            You don't have items in the cart yet
        </div> 
    </PageComponent>
</template>

<script setup>
import PageComponent from "../components/PageComponent.vue";
import store from "../store";
import { useRouter } from "vue-router";
import {computed} from 'vue';
import CartListView from "../components/CartListView.vue";

const cartItems = computed(() => store.state.cartItems);
const totals = computed(()=> store.getters.calcSum);
const router= useRouter();

const order = {
  delivered: 0,
};


function saveOrder(ev) {
    ev.preventDefault();
    if(confirm("Are you sure for checkout?")){
        store
        .dispatch('saveOrder',order)
        .then(() => {
            store.commit("notify", {
            type: "success",
            message: "The order has been successfully created",
        });
        router.push({
            name: "Orders",
        });
        })
    }
}

store.dispatch("getCartItems");

</script>
<style scoped>


</style>
