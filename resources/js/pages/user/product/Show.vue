<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';

import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
} from '@/components/ui/card';
import CardFooter from '@/components/ui/card/CardFooter.vue';

interface Props {
    product: any;
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Product',
        href: '/user/product',
    },
    {
        title: props.product.title,
        href: '/user/product/' + props.product.id,
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

    form.post(route('user.add-to-cart'));
}

</script>

<template>
    <Head title="props.product.title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

            <Card>
                <CardHeader>
                    <CardDescription>
                        <strong>Product Details</strong>
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                        <div class="grid items-center w-full gap-4">
                            <div class="flex flex-col space-y-1.5">
                                <p class="text-sm text-muted-foreground">Title</p>
                                <Label>{{ props.product.title ?? '-' }}</Label>
                            </div>

                            <div class="flex flex-col space-y-1.5">
                                <p class="text-sm text-muted-foreground">Description</p>
                                <Label>{{ props.product.description ?? '-' }}</Label>
                            </div>

                            <div class="flex flex-col space-y-1.5">
                                <p class="text-sm text-muted-foreground">Base Price</p>
                                <Label>{{ props.product.base_price ?? '-' }}</Label>
                            </div>

                            <div class="flex flex-col space-y-1.5">
                                <p class="text-sm text-muted-foreground">Member Price</p>
                                <Label>{{ props.product.discounted_price_for_member ?? '-' }}</Label>
                            </div>

                            <div class="flex flex-col space-y-1.5">
                                <p class="text-sm text-muted-foreground">Is Available</p>
                                <Label>{{ props.product.is_available ? 'Yes' : 'No' }}</Label>
                            </div>
                        </div>
                    </div>
                </CardContent>
                <CardFooter>
                    <button type="button" @click="addToCart(props.product)"
                        class="grow text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Add to Cart (RM {{ props.product.price }})
                    </button>
                </CardFooter>
            </Card>
        </div>
    </AppLayout>
</template>
