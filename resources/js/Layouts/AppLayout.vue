<script setup>
import Toaster from '@/Components/ui/toast/Toaster.vue'
</script>

<template>
    <div id="app-layout">
        <main>
            <slot />
            <Toaster />
        </main>
    </div>
</template>
