<script setup>
import { Head } from '@inertiajs/vue3'
import { computed } from 'vue'

import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card'
import {
    Table,
    TableBody,
    TableCell,
    TableFooter,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { useOrderStore } from '@/Stores/orderStore'

// Setup reactive products list and user tier
const orderStore = useOrderStore()
const orders = computed(() => orderStore.orders)
</script>

<template>
    <Head title="Orders" />

    <AuthenticatedLayout>
        <!-- No orders available -->
        <div
            v-if="orders?.orders?.length === 0"
            class="flex flex-1 items-center justify-center rounded-lg border border-dashed shadow-sm"
        >
            <div class="flex flex-col items-center gap-1 text-center">
                <h3 class="text-2xl font-bold tracking-tight">
                    You have no orders
                </h3>
            </div>
        </div>

        <div v-else>
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
                    <Card v-for="(order, index) in orders.orders" :key="order">
                        <CardHeader
                            class="flex flex-col md:flex-row justify-between gap-4 md:gap-1.5 items-center"
                        >
                            <div class="flex flex-col gap-2 w-full">
                                <CardTitle
                                    class="flex flex-row justify-between items-center"
                                >
                                    <span class="text-lg">
                                        Order #{{ index + 1 }}
                                    </span>
                                    <span class="text-muted-foreground text-sm">
                                        {{
                                            new Date(
                                                order.created_at
                                            ).toLocaleString()
                                        }}
                                    </span>
                                </CardTitle>
                                <CardDescription></CardDescription>
                            </div>
                        </CardHeader>
                        <CardContent>
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead
                                            class="w-[100px] sm:table-cell"
                                        >
                                            <span class="sr-only">img</span>
                                        </TableHead>
                                        <TableHead>Name</TableHead>
                                        <TableHead>Brand</TableHead>
                                        <TableHead>Category</TableHead>
                                        <TableHead>Price</TableHead>
                                        <TableHead>Quantity</TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody
                                    v-for="(item, index) in order.order_items"
                                    :key="item.product_id"
                                >
                                    <TableRow>
                                        <TableCell class="sm:table-cell">
                                            <img
                                                alt="Product image"
                                                class="aspect-square rounded-md object-cover min-w-[64px]"
                                                height="64"
                                                src="https://picsum.photos/100"
                                                width="64"
                                            />
                                        </TableCell>
                                        <TableCell class="font-medium">
                                            {{ item?.product_name }}
                                        </TableCell>
                                        <TableCell>
                                            {{ item?.product_brand }}
                                        </TableCell>
                                        <TableCell>
                                            {{ item?.product_category }}
                                        </TableCell>
                                        <TableCell>
                                            {{
                                                new Intl.NumberFormat('en-US', {
                                                    style: 'currency',
                                                    currency:
                                                        item?.price?.currency ||
                                                        'USD',
                                                }).format(
                                                    item?.price?.amount || 0
                                                )
                                            }}
                                        </TableCell>
                                        <TableCell>
                                            {{ item?.quantity }}
                                        </TableCell>
                                    </TableRow>
                                </TableBody>
                                <TableFooter class="bg-background" colspan="6">
                                    <TableCell class="text-end" colspan="6">
                                        Total: ${{ order.total_price }}
                                    </TableCell>
                                </TableFooter>
                            </Table>
                        </CardContent>
                    </Card>
                </CardContent>
            </Card>
        </div>
    </AuthenticatedLayout>
</template>
