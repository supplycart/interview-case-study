<template>
    <div class="text-center text-red-600">{{ error }}</div>
</template>

<script setup>
    const props = defineProps({
        error: {
            type: String,
            required: true,
        },
    });
</script>
  