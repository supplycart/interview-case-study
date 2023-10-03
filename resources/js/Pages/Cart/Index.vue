<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CardProduct from "@/Pages/Cart/Partials/CardProduct.vue";
import ButtonDanger from "@/Components/Buttons/ButtonDanger.vue";
import PaymentPanel from "@/Pages/Cart/Partials/PaymentPanel.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    user_carts: Array,
    carts_count: Number,
    total_price: Number,
});
const remove = (id) => {
    useForm({ id: id }).post(route("cart.remove"));
};
</script>

<template>
    <Head title="My Cart" />

    <AuthenticatedLayout :carts_count="carts_count">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Cart
            </h2>
        </template>

        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                My Cart
            </h2>

            <div v-if="props.total_price > 0" class="grid gap-4 grid-cols-2">
                <div>
                    <div
                        v-for="(user_cart, id) in props.user_carts"
                        v-bind:key="id"
                        class="mb-2 flex gap-2"
                    >
                        <CardProduct
                            class="flex-1"
                            :product="user_cart.product"
                            :hideAddToCart="true"
                        />
                        <div class="flex-none my-auto">
                            <ButtonDanger
                                icon="trash"
                                @click="remove(user_cart.id)"
                            />
                        </div>
                    </div>
                </div>
                <div>
                    <PaymentPanel :total_price="props.total_price" />
                </div>
            </div>
            <div v-else class="p-4 w-full text-center">
                No item in your cart.
            </div>
        </div>
    </AuthenticatedLayout>
</template>
