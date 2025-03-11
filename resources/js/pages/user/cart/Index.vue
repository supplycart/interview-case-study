<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { SharedData, User, type BreadcrumbItem } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/vue3';

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
import CardFooter from '@/components/ui/card/CardFooter.vue';

interface Props {
    cartItems: any;
    subtotal: string;
    roundingAdjustment: string;
    discountAmount: string;
    grandTotal: string;
}

const page = usePage<SharedData>();
const user = page.props.auth.user as User;
const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Cart',
        href: '/user/cart',
    },
];

function removeFromCart(cartItemId: number)
{
    let form = useForm({});

    form.delete(route('user.cart.destroy', cartItemId));
}

function confirmOrder()
{
    let cartItemIds = props.cartItems.data.map((cartItem: any) => {
        return cartItem.id
    })

    if (cartItemIds.length > 0)
    {
        let form = useForm({
            user_id: user.id,
            cart_item_ids: cartItemIds
        });

        form.post(route('user.order.store'));
    }
}

function open(id: number)
{
    window.location.href = '/user/product/'+id;
}

</script>

<template>
    <Head title="Cart" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

            <Card>
                <CardHeader>
                    <CardDescription>
                        <strong>Cart Items</strong>
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <Table v-if="props.cartItems.data.length > 0">
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
                                <TableCell class="font-medium cursor-pointer" @click="open(cartItem.product_id)">
                                    {{ cartItem.product_title }}
                                </TableCell>
                                <TableCell>{{ cartItem.product_description }}</TableCell>
                                <TableCell>{{ cartItem.financial_unit_price }}</TableCell>
                                <TableCell>{{ cartItem.quantity }}</TableCell>
                                <TableCell>{{ cartItem.financial_subtotal }}</TableCell>
                                <TableCell>
                                    <button @click="removeFromCart(cartItem.id)">
                                        Remove
                                    </button>
                                </TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell ColSpan="2"></TableCell>
                                <TableCell ColSpan="2">Subtotal</TableCell>
                                <TableCell>{{ subtotal }}</TableCell>
                                <TableCell></TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell ColSpan="2"></TableCell>
                                <TableCell ColSpan="2">Rounding</TableCell>
                                <TableCell>{{ roundingAdjustment }}</TableCell>
                                <TableCell></TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell ColSpan="2"></TableCell>
                                <TableCell ColSpan="2">Discount</TableCell>
                                <TableCell>{{ discountAmount }}</TableCell>
                                <TableCell></TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell ColSpan="2"></TableCell>
                                <TableCell ColSpan="2">Grand Total</TableCell>
                                <TableCell>{{ grandTotal }}</TableCell>
                                <TableCell></TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>

                    <div v-if="props.cartItems.data.length <= 0">
                        Your cart is empty.
                    </div>
                </CardContent>
                <CardFooter class="flex flex-grow" v-if="props.cartItems.data.length > 0">
                    <button type="button" @click="confirmOrder()"
                        class="grow text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Place Order
                    </button>
                </CardFooter>
            </Card>
        </div>
    </AppLayout>
</template>
