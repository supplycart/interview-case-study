<script setup>
const model = defineModel({ type: [String, Number, null], default: null });
</script>

<template>
    <div v-if="model" class="text-red-500">
        {{ model }}
    </div>
</template>
