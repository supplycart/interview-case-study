<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { SharedData, User, type BreadcrumbItem } from '@/types';
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
import TableFooter from '@/components/ui/table/TableFooter.vue';

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
        href: '/cart',
    },
];

function removeFromCart(cartItemId: number)
{
    let form = useForm({});

    form.delete(route('cart.destroy', cartItemId));
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

        form.post(route('order.store'));
    }
}

</script>

<template>
    <Head title="Cart" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
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
                <TableFooter>
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
                    <TableRow>
                        <TableCell ColSpan="2"></TableCell>
                        <TableCell ColSpan="2">Confirm Purchase</TableCell>
                        <TableCell>
                            <Button @click="confirmOrder()">
                                OK
                            </Button>
                        </TableCell>
                        <TableCell></TableCell>
                    </TableRow>
                </TableFooter>
            </Table>

            <div v-if="props.cartItems.data.length <= 0">
                Your cart is empty.
            </div>
        </div>
    </AppLayout>
</template>
