<script setup>
const props = defineProps({
    message: String,
});
</script>


<template>
    <div v-if="props.message" class="bg-green-300 text-green-700 border-green-500 w-full p-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{ props.message }}
        </div>
    </div>
</template>
