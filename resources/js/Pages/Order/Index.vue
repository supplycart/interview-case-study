<template>
    <div class="h-full rounded-lg bg-white p-3">
        <p class="text-xl font-bold mr-4 mb-3">Order History</p>

        <div v-for="order in orders" class="mt-10">
            <div class="flex justify-between">
                <span
                    class="rounded-full bg-lime-500 px-2 text-white font-bold"
                >
                    SC-{{ order.id }}
                </span>
                <span>
                    {{ moment(order.created_at).format("DD MMM Y HH:mm:ss") }}
                </span>
            </div>
            <div
                class="grid grid-cols-4 gap-4 items-center justify-items-center"
            >
                <p class="font-bold">Product</p>
                <p class="font-bold">Name</p>
                <p class="font-bold">Quantity</p>
                <p class="font-bold">Total Price</p>
                <template v-for="order_detail in order.order_details">
                    <img
                        :src="order_detail.product.image"
                        alt=""
                        class="h-32 mr-5 mb-5"
                    />
                    <p class="justify-self-start">
                        {{ order_detail.product_name }}
                    </p>
                    <p>{{ order_detail.quantity }}</p>
                    <p v-if="productDiscount > 0">
                        RM{{ order_detail.total_nett }}
                        <s class="text-slate-400 text-sm ml-3">
                            RM{{ order_detail.total_amount }}</s
                        >
                    </p>
                    <p v-else>RM{{ order_detail.total_nett }}</p>
                </template>

                <p class="col-span-3 justify-self-end font-bold">Total:</p>
                <p>RM{{ order.total_nett }}</p>
            </div>
            <hr />
        </div>
    </div>
</template>

<script>
import { usePage } from "@inertiajs/vue3";
import moment from "moment";

export default {
    props: {
        orders: Object,
    },
    data: () => ({
        moment: moment,
        productDiscount: Number(
            usePage().props.auth.user.membership_level.discount
        ),
    }),
};
</script>
