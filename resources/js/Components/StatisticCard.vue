<template>
    <div class="space-y-2 w-full">
        <div
            class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500 dark:text-gray-400">
            <span>{{ name }}</span>
        </div>

        <div class="text-3xl dark:text-gray-100">
            {{ number }}
        </div>
    </div>
</template>

<script setup>
defineProps({
    name: String,
    number: Number
})
</script>
