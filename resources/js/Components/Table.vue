<template>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <TableHeader :headers="headers" />
        <TableBody :rows="body" />
    </table>
</template>

<script setup>
import TableHeader from "@/Components/TableHeader.vue";
import TableBody from "@/Components/TableBody.vue";

const props = defineProps({
    headers: Array,
    body: Array
});
</script>
