<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label class="text-[14px] text-gray-900 font-normal">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
