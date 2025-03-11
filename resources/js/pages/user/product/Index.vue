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

interface Props {
    products: any;
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Product',
        href: '/user/product',
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
    <Head title="Product" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

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
