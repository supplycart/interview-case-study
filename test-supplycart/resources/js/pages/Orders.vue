
<script setup async lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import OrderItem from '../components/OrderItem.vue';
const props = defineProps({
    data: {
        type: Array
    },
});
console.log(props.data);

</script>

<template>
    <Head title="Order" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div v-if="$page.props.data">
                    <div v-for="(order, index) in data" class="align-top">
                        <OrderItem :order="order" :order_id="index" :grand_total="order.grand_total"/>
                    </div>
                </div>
                <div v-else>
                    No orders.
                </div>
            </div>
        </div>
    </AppLayout>
</template>