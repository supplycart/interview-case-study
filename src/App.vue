<template>
  <div class="min-h-screen bg-gray-50">
    <div class="relative w-full overflow-y-auto">
      <div class="absolute top-0 right-0">
        <notification />
      </div>

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
