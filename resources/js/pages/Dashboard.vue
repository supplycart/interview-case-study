<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';

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
import { Folder, FolderClock, ShoppingBag } from 'lucide-vue-next';

interface Props {
    products: any;
    countProducts: number;
    countCartItems: number;
    countOrders: number;
    sumOfGrandTotalOrders: number;
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

function addToCart(product: any)
{
    let form = useForm({
        product_id: product.id,
        product_title: product.title,
        product_description: product.description,
        quantity: 1,
        unit_price: product.price,
    })

    form.post(route('add-to-cart'));
}

</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">

                    <a href="/user/product">
                        <div class="max-w-sm p-6">
                            <div class="py-3">
                                <Folder></Folder>
                            </div>

                            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Products</h5>
                            <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                                {{ props.countProducts }} products available
                            </p>
                        </div>
                    </a>

                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">

                    <a href="/user/product">
                        <div class="max-w-sm p-6">
                            <div class="py-3">
                                <FolderClock></FolderClock>
                            </div>

                            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Order History</h5>
                            <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                                RM {{ props.sumOfGrandTotalOrders }} ({{ props.countOrders }} purchases)
                            </p>
                        </div>
                    </a>

                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">

                    <a href="/user/product">
                        <div class="max-w-sm p-6">
                            <div class="py-3">
                                <ShoppingBag></ShoppingBag>
                            </div>

                            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Cart</h5>
                            <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                                {{ props.countCartItems }}  items currently in cart
                            </p>
                        </div>
                    </a>

                </div>
            </div>

            <Card>
                <CardHeader>
                    <CardDescription>
                        <strong>Product Listing</strong>
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <Table v-if="props.products.data.length > 0">
                        <TableHeader>
                            <TableRow>
                                <TableHead>Title</TableHead>
                                <TableHead>Description</TableHead>
                                <TableHead>Price</TableHead>
                                <TableHead></TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="product in props.products.data">
                                <TableCell class="font-medium">{{ product.title }}</TableCell>
                                <TableCell>{{ product.description }}</TableCell>
                                <TableCell>{{ product.price }}</TableCell>
                                <TableCell>
                                    <button @click="addToCart(product)">Add To Cart</button>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>

                    <div v-if="props.products.data.length <= 0">
                        Product is empty
                    </div>
                </CardContent>
            </Card>

        </div>
    </AppLayout>
</template>
