<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    cart: Object,
    checkout_summary: Object,
});

function formatPrice(price) {
    return (Math.round(price * 100) / 100).toFixed(2);
}
</script>

<template>
    <Head title="Checkout" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Checkout
            </h2>
        </template>

        <div class="mx-auto max-w-7xl py-12 sm:px-6 lg:px-8">
            <div
                class="flex justify-center overflow-hidden bg-white px-4 py-8 shadow-sm sm:rounded-lg"
            >
                <div class="mx-auto w-full md:max-w-5xl">
                    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                        <div class="max-md:order-1 lg:col-span-2">
                            <h2 class="text-3xl font-extrabold text-gray-800">
                                Make a payment
                            </h2>
                            <p class="mt-4 text-sm text-gray-800">
                                Complete your transaction swiftly and securely
                                with our easy-to-use payment process.
                            </p>

                            <form class="mt-8 max-w-lg">
                                <div class="grid gap-4">
                                    <h3
                                        class="text-2xl font-extrabold text-gray-800"
                                    >
                                        Delivery Information
                                    </h3>
                                    <div>
                                        <TextInput
                                            type="text"
                                            placeholder="Contact Name"
                                            class="w-full bg-gray-100 px-4 py-3.5 text-sm text-gray-800 focus:bg-transparent"
                                        />
                                    </div>
                                    <div>
                                        <TextInput
                                            type="number"
                                            placeholder="Contact Name"
                                            class="w-full bg-gray-100 px-4 py-3.5 text-sm text-gray-800 focus:bg-transparent"
                                        />
                                    </div>
                                    <div>
                                        <TextInput
                                            type="text"
                                            placeholder="Address"
                                            class="w-full bg-gray-100 px-4 py-3.5 text-sm text-gray-800 focus:bg-transparent"
                                        />
                                    </div>
                                    <div>
                                        <TextInput
                                            type="text"
                                            placeholder="Postcode"
                                            class="w-full bg-gray-100 px-4 py-3.5 text-sm text-gray-800 focus:bg-transparent"
                                        />
                                    </div>
                                    <div>
                                        <TextInput
                                            type="text"
                                            placeholder="City"
                                            class="w-full bg-gray-100 px-4 py-3.5 text-sm text-gray-800 focus:bg-transparent"
                                        />
                                    </div>
                                    <div>
                                        <TextInput
                                            type="text"
                                            placeholder="State"
                                            class="w-full bg-gray-100 px-4 py-3.5 text-sm text-gray-800 focus:bg-transparent"
                                        />
                                    </div>
                                    <div>
                                        <textarea
                                            type="text"
                                            placeholder="Special Remarks"
                                            class="w-full rounded-md border-gray-300 bg-gray-100 px-4 py-3.5 text-sm text-gray-800 shadow-sm focus:border-indigo-500 focus:bg-transparent focus:ring-indigo-500"
                                        />
                                    </div>

                                    <h3
                                        class="text-2xl font-extrabold text-gray-800"
                                    >
                                        Payment Details
                                    </h3>
                                    <div>
                                        <TextInput
                                            type="text"
                                            placeholder="Cardholder's Name"
                                            class="w-full bg-gray-100 px-4 py-3.5 text-sm text-gray-800 focus:bg-transparent"
                                        />
                                    </div>

                                    <div
                                        class="flex overflow-hidden rounded-md border border-gray-300 bg-gray-100 shadow-sm focus-within:border-indigo-500 focus-within:bg-transparent focus-within:outline"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="ml-3 w-6"
                                            viewBox="0 0 32 20"
                                        >
                                            <circle
                                                cx="10"
                                                cy="10"
                                                r="10"
                                                fill="#f93232"
                                                data-original="#f93232"
                                            />
                                            <path
                                                fill="#fed049"
                                                d="M22 0c-2.246 0-4.312.75-5.98 2H16v.014c-.396.298-.76.634-1.107.986h2.214c.308.313.592.648.855 1H14.03a9.932 9.932 0 0 0-.667 1h5.264c.188.324.365.654.518 1h-6.291a9.833 9.833 0 0 0-.377 1h7.044c.104.326.186.661.258 1h-7.563c-.067.328-.123.66-.157 1h7.881c.039.328.06.661.06 1h-8c0 .339.027.67.06 1h7.882c-.038.339-.093.672-.162 1h-7.563c.069.341.158.673.261 1h7.044a9.833 9.833 0 0 1-.377 1h-6.291c.151.344.321.678.509 1h5.264a9.783 9.783 0 0 1-.669 1H14.03c.266.352.553.687.862 1h2.215a10.05 10.05 0 0 1-1.107.986A9.937 9.937 0 0 0 22 20c5.523 0 10-4.478 10-10S27.523 0 22 0z"
                                                class="hovered-path"
                                                data-original="#fed049"
                                            />
                                        </svg>
                                        <TextInput
                                            type="number"
                                            placeholder="Card Number"
                                            class="w-full border-none bg-gray-100 px-4 py-3.5 text-sm text-gray-800 shadow-none focus:border-transparent focus:bg-transparent focus:ring-transparent"
                                        />
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <TextInput
                                                type="number"
                                                placeholder="EXP."
                                                class="w-full bg-gray-100 px-4 py-3.5 text-sm text-gray-800 focus:bg-transparent"
                                            />
                                        </div>
                                        <div>
                                            <TextInput
                                                type="number"
                                                placeholder="CVV"
                                                class="w-full bg-gray-100 px-4 py-3.5 text-sm text-gray-800 focus:bg-transparent"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <button
                                    type="button"
                                    class="mt-8 w-40 rounded-md bg-blue-700 py-3.5 text-sm tracking-wide text-white hover:bg-blue-800"
                                >
                                    Pay
                                </button>
                            </form>
                        </div>

                        <div
                            class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6"
                        >
                            <h2 class="text-3xl font-extrabold text-gray-800">
                                RM {{ formatPrice(checkout_summary.net_price) }}
                            </h2>

                            <ul class="mt-8 space-y-4 text-gray-800">
                                <li
                                    class="flex flex-wrap gap-4 text-sm"
                                    v-for="item in cart.items"
                                    :key="item.id"
                                >
                                    {{ item.product_variation.product.name }}
                                    <span class="ml-auto font-bold"
                                        >RM
                                        {{
                                            formatPrice(
                                                item.product_variation.price *
                                                    item.quantity,
                                            )
                                        }}</span
                                    >
                                </li>
                                <li class="flex flex-wrap gap-4 text-sm">
                                    Tax
                                    <span class="ml-auto font-bold"
                                        >RM
                                        {{
                                            formatPrice(checkout_summary.tax)
                                        }}</span
                                    >
                                </li>
                                <li
                                    class="flex flex-wrap gap-4 border-t-2 pt-4 text-sm font-bold"
                                >
                                    Total
                                    <span class="ml-auto"
                                        >RM
                                        {{
                                            formatPrice(
                                                checkout_summary.net_price,
                                            )
                                        }}</span
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
