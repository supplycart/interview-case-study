<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table';

import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
} from '@/components/ui/card';

interface Props {
    order: any;
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Order',
        href: '/order',
    },
    {
        title: props.order.number,
        href: '/order',
    },
];

</script>

<template>
    <Head title="props.order.number" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

            <Card>
                <CardHeader>
                    <CardDescription>
                        <strong>Order Details</strong>
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                        <div class="grid items-center w-full gap-4">
                            <div class="flex flex-col space-y-1.5">
                                <p class="text-sm text-muted-foreground">Name</p>
                                <Label>{{ props.order.name ?? '-' }}</Label>
                            </div>

                            <div class="flex flex-col space-y-1.5">
                                <p class="text-sm text-muted-foreground">Phone No.</p>
                                <Label>{{ props.order.phone_no ?? '-' }}</Label>
                            </div>

                            <div class="flex flex-col space-y-1.5">
                                <p class="text-sm text-muted-foreground">Email</p>
                                <Label>{{ props.order.email ?? '-' }}</Label>
                            </div>

                            <div class="flex flex-col space-y-1.5">
                                <p class="text-sm text-muted-foreground">Order No.</p>
                                <Label>{{ props.order.number ?? '-' }}</Label>
                            </div>
                        </div>

                        <div class="grid items-center w-full gap-4">
                            <div class="flex flex-col space-y-1.5">
                                <p class="text-sm text-muted-foreground">Address Line 1</p>
                                <Label>{{ props.order.address_line_1 ?? '-' }}</Label>
                            </div>

                            <div class="flex flex-col space-y-1.5">
                                <p class="text-sm text-muted-foreground">Address Line 2</p>
                                <Label>{{ props.order.address_line_2 ?? '-' }}</Label>
                            </div>

                            <div class="flex flex-col space-y-1.5">
                                <p class="text-sm text-muted-foreground">Address Line 3</p>
                                <Label>{{ props.order.address_line_3 ?? '-' }}</Label>
                            </div>
                        </div>
                    </div>
                </CardContent>
            </Card>

            <Card>
                <CardHeader>
                    <CardDescription>
                        <strong>Order Item Details</strong>
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <Table v-if="props.order.order_items && props.order.order_items.length > 0">
                        <TableHeader>
                            <TableRow>
                                <TableHead>#</TableHead>
                                <TableHead>Title</TableHead>
                                <TableHead>Description</TableHead>
                                <TableHead>Unit Price</TableHead>
                                <TableHead>Quantity</TableHead>
                                <TableHead>Subtotal</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="(orderItem, index) in props.order.order_items">
                                <TableCell>{{ index + 1 }}</TableCell>
                                <TableCell class="font-medium">{{ orderItem.product_title }}</TableCell>
                                <TableCell>{{ orderItem.product_description }}</TableCell>
                                <TableCell>{{ orderItem.unit_price }}</TableCell>
                                <TableCell>{{ orderItem.quantity }}</TableCell>
                                <TableCell>{{ orderItem.subtotal }}</TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell Colspan="3"></TableCell>
                                <TableCell Colspan="2">Subtotal</TableCell>
                                <TableCell>{{ props.order.subtotal }}</TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell Colspan="3"></TableCell>
                                <TableCell Colspan="2">Rounding</TableCell>
                                <TableCell>{{ props.order.rounding_adjustment }}</TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell Colspan="3"></TableCell>
                                <TableCell Colspan="2">Discount</TableCell>
                                <TableCell>{{ props.order.discount_amount }}</TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell Colspan="3"></TableCell>
                                <TableCell Colspan="2">Grand Total</TableCell>
                                <TableCell>{{ props.order.grand_total }}</TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
