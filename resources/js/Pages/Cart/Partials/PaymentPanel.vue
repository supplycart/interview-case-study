<script setup>
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue"
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    total_price: Number,
});
const order = () => useForm({}).post(route("order.create"));
</script>

<template>
    <div class="bg-white p-4 rounded-xl shadow">
        <div class="text-center mt-4 mb-2 text-slate-500 font-semibold">
            Total Price:
        </div>
        <div class="text-center my-4 font-bold text-3xl text-main-700">
            RM {{ props.total_price.toFixed(2) }}
        </div>
        <ButtonPrimary
            class="w-full mt-8"
            text="Order"
            textSize="text-xl"
            @click="order"
        />
    </div>
</template>
