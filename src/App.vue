<template>
  <div class="min-h-screen flex bg-gray-50 pb-12 sm:px-6 lg:px-8">
    <div class="relative w-full flex-1 flex flex-col overflow-y-auto">
      <div id="navbar" />

      <div class="absolute top-0 right-0">
        <notification />
      </div>

      <div id="breadcrumbs" class="px-4 py-2 sm:px-6"></div>

      <router-view />
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import Notification from '@/components/Notification.vue'

export default defineComponent({
  components: {
    Notification,
  },
  setup(): Record<string, unknown> {
    return {}
  },
})
</script>
