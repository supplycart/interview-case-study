<script setup>
import { computed } from 'vue'

import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card'

import IndividualOrderCard from './IndividualOrderCard.vue'

// Define Props
const props = defineProps({
    orders: Object,
})

const orders = computed(() => props.orders.orders)
</script>

<template>
    <Card>
        <CardHeader
            class="flex flex-col md:flex-row justify-between gap-4 md:gap-1.5 items-center"
        >
            <div class="flex flex-col gap-2">
                <CardTitle>Orders</CardTitle>
                <CardDescription>
                    Here are a list of orders that you've made.
                </CardDescription>
            </div>
        </CardHeader>
        <CardContent class="flex flex-col gap-4">
            <IndividualOrderCard :orders="orders" />
        </CardContent>
    </Card>
</template>
