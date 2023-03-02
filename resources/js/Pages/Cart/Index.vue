<template>
    <div class="h-full rounded-lg bg-white p-3">
        <p class="text-xl font-bold mr-4 mb-3">Your Cart</p>

        <div class="grid grid-cols-4 gap-4 items-center justify-items-center">
            <p class="font-bold">Product</p>
            <p class="font-bold">Name</p>
            <p class="font-bold">Quantity</p>
            <p class="font-bold">Total Price</p>
            <template v-for="cart in carts">
                <img :src="cart.product.image" alt="" class="h-32 mr-5 mb-5" />
                <p class="justify-self-start">{{ cart.product.name }}</p>
                <input
                    type="number"
                    class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-14 rounded-md sm:text-sm focus:ring-1"
                    v-model="cart.quantity"
                />
                <p v-if="productDiscount > 0">
                    RM{{
                        (cart.product.discounted_price * cart.quantity).toFixed(
                            2
                        )
                    }}
                    <s class="text-slate-400 text-sm ml-3">
                        RM{{
                            (cart.product.price * cart.quantity).toFixed(2)
                        }}</s
                    >
                </p>
                <p v-else>
                    RM{{ (cart.product.price * cart.quantity).toFixed(2) }}
                </p>
            </template>

            <p class="col-span-3 justify-self-end font-bold">Total:</p>
            <p>RM{{ totalPrice.toFixed(2) }}</p>
        </div>

        <div class="flex justify-end mt-5 mx-20">
            <button
                class="bg-lime-500 px-2 rounded text-white text-lg"
                @click="checkout"
            >
                Checkout
            </button>
        </div>
    </div>
</template>

<script>
import { usePage } from "@inertiajs/vue3";
import axios from "axios";
import Swal from "sweetalert2";
import { router } from "@inertiajs/vue3";

export default {
    props: {
        carts: Object,
    },
    data() {
        return {
            productDiscount: Number(
                usePage().props.auth.user.membership_level.discount
            ),
        };
    },
    computed: {
        totalPrice() {
            let totalPrice = this.carts.reduce((sum, cart) => {
                if (this.productDiscount > 0) {
                    sum += cart.product.discounted_price * cart.quantity;
                } else {
                    sum += cart.product.price * cart.quantity;
                }
                return sum;
            }, 0);

            return totalPrice;
        },
    },
    methods: {
        checkout() {
            axios.post("/carts/checkout", this.carts).then((response) => {
                Swal.fire({
                    title: "Success!",
                    text: response.data,
                    icon: "success",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                }).then((result) => {
                    if (result.value) {
                        router.get("/orders");
                    }
                });
            });
        },
    },
    mounted() {},
};
</script>
