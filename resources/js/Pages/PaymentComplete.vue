<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    orderNumber: {
        type: String,
        required: true
    }
});
</script>

<template>
    <Head title="Payment Complete" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                Payment Complete
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-100">
                        <h3 class="text-2xl font-semibold mb-4">Thank you for your purchase!</h3>
                        <p class="mb-4">Your order ({{ orderNumber }}) has been successfully processed.</p>
                        <p>You will receive a confirmation email shortly.</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
