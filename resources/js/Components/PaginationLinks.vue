<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    paginatorLinks: {
        type: Object,
        required: true,
    },
});

</script>

<template>
    <Link
        v-for="link in paginatorLinks"
        :key="link.label"
        :href="link.url"
        v-html="link.label"
        :class="{
            'text-slate-300': !link.url,
            'font-medium text-blue-500': link.active,
        }"
    >
    </Link>
</template>
