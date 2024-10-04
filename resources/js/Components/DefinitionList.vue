<template>
    <dl class="sm:flex items-center justify-between gap-4">
        <dt class="font-normal mb-1 sm:mb-0 text-gray-500">{{ item }}</dt>
        <dd class="font-medium text-gray-900 sm:text-end">{{ value }}</dd>
    </dl>
</template>
<script setup>
import { defineProps } from 'vue'

const props = defineProps({
    item: String,
    value: String
})
</script>
