<template>
    <div>
        <div class="p-4 bg-gray-100 rounded-full">
            <h1 class="ml-2 font-bold uppercase text-center">Order Summary</h1>
        </div>
        <div class="p-4">
            <p class="mb-6 italic">Shipping fee is calculated based on delivery area.</p>
            <div class="flex justify-between border-b">
                <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                    Subtotal
                </div>
                <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                    ${{ subtotal }}
                </div>
            </div>

            <div class="flex justify-between pt-4 border-b">
                <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                    Shipping
                </div>
                <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                    ${{ shippingFee }}
                </div>
            </div>
            <div class="flex justify-between pt-4 border-b">
                <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                    Total
                </div>
                <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                    ${{ total }}
                </div>
            </div>
            <a
                v-if="actionRoute"
                :href="actionRoute"
                class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none"
            >
                <span class="ml-2 mt-5px">{{ actionText }}</span>
            </a>

            <button
                v-if="isCheckout"
                class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none"
            >
                <span class="ml-2 mt-5px">{{ actionText }}</span>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'actionRoute',
        'actionText',
        'isCheckout',
        'subtotal',
    ],
    data() {
        return {
            shippingFee: 20,
        };
    },
    computed: {
        total() {
            return (Number(this.subtotal) + this.shippingFee)
                .toFixed(2);
        },
    },
    methods: {
    },
}
</script>
