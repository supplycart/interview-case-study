<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { SharedData, type BreadcrumbItem } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/vue3';
// import { BookOpen, Folder, LayoutGrid, ShoppingBag } from 'lucide-vue-next';

import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'

interface Props {
    cartItems: any;
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Cart',
        href: '/cart',
    },
];

function removeFromCart(cartItemId: number)
{
    let form = useForm({});

    form.delete(route('cart.destroy', cartItemId));
}

</script>

<template>
    <Head title="cartItem" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Title</TableHead>
                        <TableHead>Description</TableHead>
                        <TableHead>Unit Price</TableHead>
                        <TableHead>Quantity</TableHead>
                        <TableHead>Subtotal</TableHead>
                        <TableHead></TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="cartItem in props.cartItems.data">
                        <TableCell class="font-medium">{{ cartItem.product_title }}</TableCell>
                        <TableCell>{{ cartItem.product_description }}</TableCell>
                        <TableCell>{{ cartItem.unit_price }}</TableCell>
                        <TableCell>{{ cartItem.quantity }}</TableCell>
                        <TableCell>{{ cartItem.subtotal }}</TableCell>
                        <TableCell>
                            <button @click="removeFromCart(cartItem.id)">
                                Remove
                            </button>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>
