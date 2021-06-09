<template>
  <div class="relative max-w-full mx-auto">
    <div class="absolute top-0 right-0">
      <notification />
    </div>
    <router-view />
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
