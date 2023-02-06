<template>
    <PageComponent title="Orders">
        <div v-if="orders.data.length">
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 md:grid-cols-2">
                <OrderView
                v-for="(order, ind) in orders.data"
                :key="order.id"
                :order="order"
                />
            </div>
        </div>
        <div v-else class="text-gray-600 text-center py-16">
            You don't have orders
        </div> 
    </PageComponent>
</template>

<script setup>
import store from "../store";
import OrderView from "../components/OrderView.vue";
import PageComponent from "../components/PageComponent.vue";
import {computed} from 'vue';

const orders = computed(() => store.state.orders);
store.dispatch("getOrders");

</script>