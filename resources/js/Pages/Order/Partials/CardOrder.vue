<script setup>
import { datetime } from "@/Helpers"

const props = defineProps({
    order: {
        type: Object,
    },
});
</script>

<template>
    <div class="bg-white p-4 rounded-xl shadow">
        <p class="text-center">
            {{ datetime.format(props.order.created_at, "DD MMM YYYY") }}
        </p>

        <div class="flex gap-4">
            <div class="flex-1 text-sm text-slate-500">
                <div v-for="(product, i) in props.order.products" :key="i" class="flex">
                    <div class="flex-1">
                        {{ product.name }}
                    </div>
                    <div class="flex-none">
                        RM {{ product.price.toFixed(2) }}
                    </div>
                </div>
            </div>
            <div>
                <div class="flex-none font-semibold text-lg text-main-700 text-right w-32">
                    RM {{ props.order.total_amount.toFixed(2) }}
                </div>
            </div>
        </div>
    </div>
</template>
