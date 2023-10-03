<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CardProduct from "@/Components/Cards/CardProduct.vue";
import NotifyMessage from "@/Components/Layouts/NotifyMessage.vue";
import Pagination from "@/Components/Layouts/Pagination.vue";
import { usePage } from '@inertiajs/vue3'
import { ref } from 'vue'

const message = ref(null);
const props = defineProps({
    products: Object,
});
const updateMessage = () => {
    message.value = usePage().props.flash?.message;
}
</script>

<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home
            </h2>
        </template>

        <NotifyMessage :message="message" />

        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                Product List
            </h2>

            <div class="grid gap-4 grid-cols-4">
                <CardProduct
                    v-for="(product, id) in props.products.data"
                    v-bind:key="id"
                    :product="product"
                    @updateMessage="updateMessage"
                />
            </div>
        </div>

        <Pagination :links="props.products.links" />
    </AuthenticatedLayout>
</template>
