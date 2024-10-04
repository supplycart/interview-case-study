<template>
    <p class="font-medium text-gray-900 md:mt-10">
        {{ currentOrderStatus.copy }} on <time>{{ currentOrderStatus.date }}</time>
    </p>
    <div class="my-6">
        <div class="overflow-hidden rounded-full bg-gray-200">
            <div class="h-2 rounded-full bg-indigo-600" :style="{ width: `calc((${currentOrderStatus.step} * 2 + 1) / 5 * 100%)` }" />
        </div>
        <div class="mt-6 hidden grid-cols-3 font-medium text-gray-600 sm:grid">
            <div class="text-indigo-600">Order placed</div>
            <div :class="[currentOrderStatus.step > 0 ? 'text-indigo-600' : '', 'text-center']">Processing</div>
            <div :class="[currentOrderStatus.step > 1 ? 'text-indigo-600' : '', 'text-right']">Completed</div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    currentOrderStatus: Object
});
</script>
