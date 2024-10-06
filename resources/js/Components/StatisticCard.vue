<template>
    <div class="space-y-2 w-full">
        <div
            class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-600">
            <span>{{ name }}</span>
        </div>

        <div class="text-3xl">
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
