<template>
    <Head :title="product.name"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ product.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-[100rem] sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="bg-white">
                        <div class="container mx-auto px-4 py-8">
                            <div class="flex flex-wrap -mx-4">
                                <DetailImage :product="product"/>
                                <DetailDescription :product="product"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import DetailImage from "@/Pages/Product/Partial/DetailImage.vue";
import DetailDescription from "@/Pages/Product/Partial/DetailDescription.vue";

defineProps({
    product: Object
})
</script>
