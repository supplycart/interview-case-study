<template>
    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            <th v-for="header in headers" scope="col" class="px-6 py-3">
                {{ header }}
            </th>
        </tr>
    </thead>
</template>

<script setup>
const props = defineProps({
    headers: Array
});
</script>
