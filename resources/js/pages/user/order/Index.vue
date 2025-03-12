<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, } from '@inertiajs/vue3';

import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'

import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
} from '@/components/ui/card';

interface Props {
    orders: any;
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Order',
        href: '/user/order',
    },
];

function open(id: number)
{
    window.location.href = '/user/order/'+id;
}

</script>

<template>
    <Head title="Order" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

            <Card>
                <CardHeader>
                    <CardDescription>
                        <strong>Order Listing</strong>
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <Table v-if="props.orders.data.length > 0">
                        <TableHeader>
                            <TableRow>
                                <TableHead>Number</TableHead>
                                <TableHead>Subtotal</TableHead>
                                <TableHead>Rounding</TableHead>
                                <TableHead>GrandTotal</TableHead>
                                <TableHead>Created At</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="order in props.orders.data" v-on:click="open(order.id)" class="cursor-pointer">
                                <TableCell class="font-medium">{{ order.number }}</TableCell>
                                <TableCell>{{ order.financial_subtotal }}</TableCell>
                                <TableCell>{{ order.rounding_adjustment }}</TableCell>
                                <TableCell>{{ order.financial_grand_total }}</TableCell>
                                <TableCell>{{ order.created_at }}</TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>

                    <div v-if="props.orders.data.length <= 0">
                        Orders is empty.
                    </div>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
