<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, router } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    cartItems: Array,
});

const form = useForm({
    cartItems: props.cartItems,
});

const checkout = () => {
    form.post(route("orders.store"), {
        preserveState: true,
        preserveScroll: true,
        // onSuccess: () => {
        //     router.visit(route("checkout"));
        // },
    });
};

const totalCart = computed(() => {
    return props.cartItems
        .reduce((total, item) => {
            return total + item.product.price * item.quantity;
        }, 0)
        .toFixed(2);
});
</script>

<template>
    <Head title="Shopping Cart" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                Shopping Cart
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-100">
                        <h3 class="text-lg font-semibold mb-4">
                            Your Cart Items
                        </h3>
                        <div v-if="cartItems && cartItems.length > 0">
                            <div
                                v-for="item in cartItems"
                                :key="item.product.id"
                                class="mb-4 p-4 border border-gray-700 rounded-lg"
                            >
                                <h4 class="font-semibold">
                                    {{ item.product.name }}
                                </h4>
                                <p>Price: ${{ item.product.price }}</p>
                                <p>Quantity: {{ item.quantity }}</p>
                            </div>
                            <div
                                class="mt-6 p-4 border border-gray-700 rounded-lg"
                            >
                                <h4 class="font-semibold text-lg">
                                    Cart Total
                                </h4>
                                <p class="text-xl mt-2">${{ totalCart }}</p>
                            </div>
                            <div class="mt-6">
                                <button
                                    @click="checkout"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    :disabled="form.processing"
                                >
                                    {{
                                        form.processing
                                            ? "Processing..."
                                            : "Proceed to Checkout"
                                    }}
                                </button>
                            </div>
                        </div>
                        <div v-else>
                            <p>Your cart is empty.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
