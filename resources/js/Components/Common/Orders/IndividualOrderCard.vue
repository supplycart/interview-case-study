<script setup>
import { computed } from 'vue'

import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card'
import {
    Table,
    TableCell,
    TableFooter,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table'

import IndividualOrderItem from './IndividualOrderItem.vue'

// Define Props
const props = defineProps({
    orders: Object,
})

const orders = computed(() => props.orders)
</script>

<template>
    <Card v-for="(order, index) in orders" :key="order">
        <CardHeader
            class="flex flex-col md:flex-row justify-between gap-4 md:gap-1.5 items-center"
        >
            <div class="flex flex-col gap-2 w-full">
                <CardTitle class="flex flex-row justify-between items-center">
                    <span class="text-lg"> Order #{{ index + 1 }} </span>
                    <span class="text-muted-foreground text-sm">
                        {{ new Date(order.created_at).toLocaleString() }}
                    </span>
                </CardTitle>
            </div>
        </CardHeader>
        <CardContent>
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-[100px] sm:table-cell">
                            <span class="sr-only">img</span>
                        </TableHead>
                        <TableHead>Name</TableHead>
                        <TableHead>Brand</TableHead>
                        <TableHead>Category</TableHead>
                        <TableHead>Price</TableHead>
                        <TableHead>Quantity</TableHead>
                    </TableRow>
                </TableHeader>
                <IndividualOrderItem :order_items="order.order_items" />
                <TableFooter class="bg-background" colspan="6">
                    <TableCell class="text-end" colspan="6">
                        Total: ${{ order.total_price }}
                    </TableCell>
                </TableFooter>
            </Table>
        </CardContent>
    </Card>
</template>
