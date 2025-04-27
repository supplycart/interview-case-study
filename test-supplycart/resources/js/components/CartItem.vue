<script setup lang="ts">
import { computed } from 'vue';
import { Button } from '@/components/ui/button';
import { Head, useForm } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';

const props = defineProps({
    item: {
        type: Array
    }
});
</script>

<template>
    <div class="grid content-center overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
        <p>Name: {{ item.name }}</p>
        <p>Price: {{ item.price }} </p>
        <p>Quantity: {{ item.qty }}</p>
    </div>
</template>
