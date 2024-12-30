<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const props = defineProps({
    cart: Object,
    checkout_summary: Object,
});

function formatPrice(price) {
    return (Math.round(price * 100) / 100).toFixed(2);
}

const updateQuantity = (item) => {
    const form = useForm({
        cart_item_id: item.id,
        quantity: item.quantity,
    });

    form.patch(route('cart.update.quantity'), {
        onSuccess: () => {
            toast.success('Quantity updated successfully.');
        },
        onError: () => {
            toast.error('Something went wrong.');
        },
    });
};

const removeCartItem = (item) => {
    const form = useForm({
        cart_item_id: item.id,
        quantity: item.quantity,
    });

    form.delete(route('cart.delete.item'), {
        onSuccess: () => {
            toast.success('Item removed successfully.');
        },
        onError: () => {
            toast.error('Something went wrong.');
        },
    });
};
</script>

<template>
    <Head title="Cart" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                My Cart
            </h2>
        </template>
        <div class="mx-auto max-w-7xl py-12 sm:px-6 lg:px-8">
            <div
                class="flex justify-center overflow-hidden bg-white px-4 py-8 shadow-sm sm:rounded-lg"
            >
                <div class="mx-8 w-full max-w-screen-xl px-4 2xl:px-0">
                    <div
                        class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8"
                    >
                        <div class="w-full max-w-5xl flex-none lg:w-2/3">
                            <div class="space-y-6">
                                <!-- Empty Cart Placeholder -->
                                <div
                                    v-if="
                                        cart.items === null ||
                                        cart.items.length === 0
                                    "
                                    class="flex h-64 justify-center rounded-lg border border-white bg-white p-4 text-lg md:p-6"
                                >
                                    <p>Your cart is empty.</p>
                                </div>
                                <!-- Cart items -->
                                <div
                                    v-for="item in cart.items"
                                    :key="item.product_variation_id"
                                    class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm md:p-6"
                                >
                                    <div
                                        class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0"
                                    >
                                        <a href="#" class="shrink-0 md:order-1">
                                            <img
                                                class="h-40 w-40 rounded-lg"
                                                :src="
                                                    item.product_variation.image
                                                "
                                                alt="imac image"
                                            />
                                        </a>

                                        <label
                                            for="counter-input"
                                            class="sr-only"
                                            >Choose quantity:</label
                                        >
                                        <div
                                            class="flex items-center justify-between md:order-3 md:justify-end"
                                        >
                                            <div class="flex items-center">
                                                <button
                                                    type="button"
                                                    id="decrement-button"
                                                    :disabled="
                                                        item.quantity === 1
                                                    "
                                                    @click="
                                                        () => {
                                                            item.quantity--;
                                                            updateQuantity(
                                                                item,
                                                            );
                                                        }
                                                    "
                                                    class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100"
                                                >
                                                    <svg
                                                        class="h-2.5 w-2.5 text-gray-900"
                                                        aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 18 2"
                                                    >
                                                        <path
                                                            stroke="currentColor"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M1 1h16"
                                                        />
                                                    </svg>
                                                </button>
                                                <input
                                                    type="text"
                                                    id="counter-input"
                                                    data-input-counter
                                                    class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0"
                                                    placeholder=""
                                                    v-model="item.quantity"
                                                    required
                                                />
                                                <button
                                                    type="button"
                                                    id="increment-button"
                                                    @click="
                                                        () => {
                                                            item.quantity++;
                                                            updateQuantity(
                                                                item,
                                                            );
                                                        }
                                                    "
                                                    class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100"
                                                >
                                                    <svg
                                                        class="text-gray-90 h-2.5 w-2.5"
                                                        aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 18 18"
                                                    >
                                                        <path
                                                            stroke="currentColor"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 1v16M1 9h16"
                                                        />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div
                                                class="text-end md:order-4 md:w-32"
                                            >
                                                <p
                                                    class="text-base font-bold text-gray-900"
                                                >
                                                    RM
                                                    {{
                                                        formatPrice(
                                                            item
                                                                .product_variation
                                                                .price,
                                                        )
                                                    }}
                                                </p>
                                            </div>
                                        </div>

                                        <div
                                            class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md"
                                        >
                                            <a
                                                href="#"
                                                class="text-xl font-medium text-gray-900 hover:underline"
                                                >{{
                                                    item.product_variation
                                                        .product.name
                                                }}</a
                                            >
                                            <p
                                                class="flex-inital text-md mt-4 font-normal"
                                                for="quantity"
                                            >
                                                Variation:
                                                {{
                                                    item.product_variation.name
                                                }}
                                            </p>

                                            <div
                                                class="flex items-center gap-4"
                                            >
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center text-sm font-medium text-red-600 hover:underline"
                                                    @click="
                                                        removeCartItem(item)
                                                    "
                                                >
                                                    <svg
                                                        class="me-1.5 h-5 w-5"
                                                        aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24"
                                                        height="24"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke="currentColor"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M6 18 17.94 6M18 18 6.06 6"
                                                        />
                                                    </svg>
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="mx-auto mt-6 max-w-4xl flex-initial space-y-6 lg:mt-0 lg:w-full"
                        >
                            <div
                                class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6"
                            >
                                <p class="text-xl font-semibold text-gray-900">
                                    Order summary
                                </p>

                                <div class="space-y-4">
                                    <div class="space-y-2">
                                        <dl
                                            class="flex items-center justify-between gap-4"
                                        >
                                            <dt
                                                class="text-base font-normal text-gray-500"
                                            >
                                                Grand Total
                                            </dt>
                                            <dd
                                                class="text-gray-90 text-base font-medium"
                                            >
                                                RM
                                                {{
                                                    formatPrice(
                                                        checkout_summary.grand_total,
                                                    )
                                                }}
                                            </dd>
                                        </dl>

                                        <dl
                                            class="flex items-center justify-between gap-4"
                                        >
                                            <dt
                                                class="text-base font-normal text-gray-500"
                                            >
                                                Discount
                                            </dt>
                                            <dd
                                                class="text-base font-medium text-green-600"
                                            >
                                                RM
                                                {{
                                                    formatPrice(
                                                        checkout_summary.discount,
                                                    )
                                                }}
                                            </dd>
                                        </dl>

                                        <dl
                                            class="flex items-center justify-between gap-4"
                                        >
                                            <dt
                                                class="text-base font-normal text-gray-500"
                                            >
                                                SST 6%
                                            </dt>
                                            <dd
                                                class="text-base font-medium text-gray-900"
                                            >
                                                RM
                                                {{
                                                    formatPrice(
                                                        checkout_summary.tax,
                                                    )
                                                }}
                                            </dd>
                                        </dl>
                                    </div>

                                    <dl
                                        class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2"
                                    >
                                        <dt
                                            class="text-base font-bold text-gray-900"
                                        >
                                            Net Price
                                        </dt>
                                        <dd
                                            class="text-base font-bold text-gray-900"
                                        >
                                            RM
                                            {{
                                                formatPrice(
                                                    checkout_summary.net_price,
                                                )
                                            }}
                                        </dd>
                                    </dl>
                                </div>

                                <a
                                    :href="route('cart.show.checkout')"
                                    class="flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300"
                                    :class="{
                                        'pointer-events-none bg-slate-300':
                                            props.cart.items === null ||
                                            props.cart.items.length === 0,
                                    }"
                                    >Proceed to Checkout</a
                                >

                                <div
                                    class="flex items-center justify-center gap-2"
                                >
                                    <span
                                        class="text-sm font-normal text-gray-500"
                                    >
                                        or
                                    </span>
                                    <a
                                        :href="route('products.index')"
                                        title=""
                                        class="inline-flex items-center gap-2 text-sm font-medium text-blue-700 underline hover:no-underline"
                                    >
                                        Continue Shopping
                                        <svg
                                            class="h-5 w-5"
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke="currentColor"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M19 12H5m14 0-4 4m4-4-4-4"
                                            />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
