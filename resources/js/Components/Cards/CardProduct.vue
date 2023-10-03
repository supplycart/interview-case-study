<script setup>
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    product: {
        type: Object,
    },
    hideAddToCart: {
        type: Boolean,
        default: false,
    }
});
const emit = defineEmits('updateMessage');
const addToCart = (id) => {
    const form = useForm({ id: props.product.id });
    form.post(route("cart.add"), {
        onFinish: () => emit('updateMessage'),
    });
};
</script>

<template>
    <div class="bg-white p-4 rounded-xl shadow">
        <p class="text-lg">
            {{ props.product.name }}
        </p>

        <div class="flex">
            <div class="flex-1 text-sm text-slate-500">
                {{ props.product?.category?.name }}
            </div>
            <div class="flex-1 font-semibold text-main-700 text-right">
                RM {{ props.product?.price.toFixed(2) }}
            </div>
        </div>

        <ButtonPrimary
            v-if="! hideAddToCart"
            class="w-full mt-4"
            text="Add To Cart"
            icon="shopping-cart"
            @click="addToCart"
        />
    </div>
</template>
