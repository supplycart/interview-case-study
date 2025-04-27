<script setup lang="ts">
import { computed } from 'vue';
import { Button } from '@/components/ui/button';
import { Head, useForm } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
const props = defineProps({
    data: {
        type: Array
    },
});
const form = useForm({
    id: props.data.id,
    price: props.data.price,
    name: props.data.name,
});


const submit = () => {
    form.post(route('add_to_cart'));
};

</script>

<template>
    <div class="grid content-center overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
        <p>Name: {{ data.name }}</p>
        <p>Price: {{ data.price }}</p>
        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <Button
                type="submit" 
                variant="ghost"
                size="icon"
                class=" size-10 w-auto rounded-full p-1 focus-within:ring-2 focus-within:ring-primary left-9"
            >
            Add To Cart
            </Button>
        </form>
    </div>
</template>
