<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { useCartStore } from '@/stores/cart'
import { onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { useToastStore } from '@/stores/toast'

const toastStore = useToastStore()

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

const cart = useCartStore();
const page = usePage();

onMounted(() => {
    const user = page.props.auth?.user;

    if (user) {
        cart.syncToBackend().then(() => {
        cart.loadFromBackend() // optional: rehydrate after sync
        })
    }
})

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <slot />

        <div class="fixed bottom-6 right-6 space-y-2 z-50">
            <TransitionGroup name="toast" tag="div">
            <div
                v-for="toast in toastStore.toasts"
                :key="toast.id"
                class="px-4 py-2 rounded-xl text-white shadow"
                :class="{
                'bg-green-600': toast.type === 'success',
                'bg-red-600': toast.type === 'error',
                'bg-blue-600': toast.type === 'info',
                'bg-yellow-500': toast.type === 'warning',
                }"
            >
                {{ toast.message }}
            </div>
            </TransitionGroup>
        </div>

    </AppLayout>

</template>

<style scoped>
.toast-enter-active,
.toast-leave-active {
  transition: all 0.3s ease;
}
.toast-enter-from,
.toast-leave-to {
  opacity: 0;
  transform: translateY(10px);
}
</style>
