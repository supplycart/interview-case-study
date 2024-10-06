<template>
    <div class="flex flex-grow overflow-auto justify-start gap-1 mb-3">
        <span
            v-html="brand.name"
            class="bg-indigo-400 text-indigo-50 text-xs font-semibold px-2.5 py-0.5 rounded-full"
        />
        <span
            v-for="category in categories" v-html="category.name"
            class="bg-indigo-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full"
        />
    </div>
</template>

<script setup>
const props = defineProps({
    brand: Object,
    categories: Array
});
</script>
