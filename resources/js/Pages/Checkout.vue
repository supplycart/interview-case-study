<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

// Assume we're receiving the order details as a prop
const props = defineProps({
    order: {
        type: Object,
        required: true
    }
});

const form = useForm({
    id: props.order.id
});

const processPayment = () => {
    form.post(route('payment.process'), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            // Redirect to the payment complete page
            window.location.href = route('payment.complete', { orderNumber: props.order.id });
        },
    });
};
</script>

<template>
    <Head title="Checkout" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                Checkout
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-100">
                        <h3 class="text-lg font-semibold mb-4">Order Details</h3>
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-medium">Items:</h4>
                                <ul class="list-disc list-inside">
                                    <li v-for="item in order.order_items" :key="item.id">
                                        {{ item.product.name }} - ${{ item.price.toFixed(2) }} x {{ item.quantity }}
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-medium">Subtotal: ${{ order.sub_total.toFixed(2) }}</h4>
                            </div>
                            <div>
                                <h4 class="font-medium">Tax (8%): ${{ order.tax.toFixed(2) }}</h4>
                            </div>
                            <div>
                                <h4 class="font-medium">Total: ${{ order.total.toFixed(2) }}</h4>
                            </div>
                        </div>
                        <!-- Add your checkout form and payment logic here -->
                        <div class="mt-6">
                            <button
                                @click="processPayment"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
                                :disabled="form.processing"
                            >
                                {{ form.processing ? 'Processing...' : 'Proceed to Payment' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
