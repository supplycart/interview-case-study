<script setup>
import { usePage } from '@inertiajs/vue3'
import { ref, onMounted, onUpdated } from 'vue'

const message = ref(null);
const setMessage = () => message.value = usePage().props.flash?.message;

onMounted(() => setMessage());
onUpdated(() => setMessage());
</script>


<template>
    <div v-if="message" class="bg-green-300 text-green-700 border-green-500 w-full p-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{ message }}
        </div>
    </div>
</template>
