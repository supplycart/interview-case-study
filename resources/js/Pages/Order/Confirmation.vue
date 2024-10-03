<template>
    <Head title="Confirmation Order"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Confirmation Order
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <ConfirmationSummary :order="props.order" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import ConfirmationSummary from "@/Pages/Order/Partials/ConfirmationSummary.vue";

const props = defineProps({
    order: Object
})
</script>
