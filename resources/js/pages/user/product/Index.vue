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
    categories: any;
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Product',
        href: '/user/product',
    },
];

function open(id: number)
{
    window.location.href = '/user/product/'+id;
}

function addToCart(product: any)
{
    let price = parseFloat(product.price.replaceAll(',',''));
    let form = useForm({
        product_id: product.id,
        product_title: product.title,
        product_description: product.description,
        quantity: 1,
        unit_price: price,
    });

    form.post(route('user.add-to-cart'));
}

function previousPage()
{
    let currentPage = new URL(location.href).searchParams.get('page') ?? '2';

    if (currentPage == '2')
    {
        window.location.href = route('user.product.index')
    }
    else
    {
        let previousNumber = parseInt(currentPage) - 1;
        window.location.href = route('user.product.index', {'page': previousNumber})
    }
}

function nextPage()
{
    let currentPage = new URL(location.href).searchParams.get('page') ?? '1';
    let nextNumber = parseInt(currentPage) + 1;

    window.location.href = route('user.product.index', {'page': nextNumber})
}

function filterListing(categoryId : number)
{
    if (categoryId == 0)
    {
        window.location.href = route('user.product.index')
    }
    else
    {
        window.location.href = route('user.product.index', {'category_id': categoryId})
    }
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

                    <div class="flex">
                        <span @click="filterListing(0)" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 cursor-pointer">
                            All Category
                        </span>
                        <span @click="filterListing(category.id)" v-for="category in props.categories.data" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 cursor-pointer">
                            {{ category.name }}
                        </span>
                    </div>

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
                                <TableCell class="font-medium cursor-pointer" v-on:click="open(product.id)" >
                                    {{ product.title }}
                                </TableCell>
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

                    <!-- Pagination -->
                    <nav class="flex flex-row-reverse items-center gap-x-1 pt-6" aria-label="Pagination">
                        <div>
                            <button type="button" @click="previousPage()"
                                class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" aria-label="Previous">
                                <svg aria-hidden="true" class="hidden shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m15 18-6-6 6-6"></path>
                                </svg>
                                <span>Previous</span>
                            </button>
                            <button type="button" @click="nextPage()"
                                class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" aria-label="Next">
                                <span>Next</span>
                                <svg aria-hidden="true" class="hidden shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </button>
                        </div>
                    </nav>
                    <!-- End Pagination -->
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
