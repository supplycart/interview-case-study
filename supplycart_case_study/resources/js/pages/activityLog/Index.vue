<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import type { BreadcrumbItem } from '@/types'
import { computed } from 'vue'

interface ActivityLog {
  id: number
  user: string
  description: string
  created_at: string
  properties: Record<string, any>
}

const page = usePage()
const logs = computed(() => page.props.logs as ActivityLog[])

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Activity Log', href: '/activity-log' },
]
</script>

<template>
  <Head title="Activity Log" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="max-w-4xl mx-auto p-6 space-y-6">
      <h1 class="text-2xl font-bold">🧾 Activity Log</h1>

      <div v-if="!logs.length" class="text-gray-500">No activity recorded.</div>

      <div v-else class="space-y-2">
        <div
          v-for="log in logs"
          :key="log.id"
          class="p-4 border rounded bg-white dark:bg-gray-900 shadow-sm"
        >
          <div class="flex justify-between text-sm text-gray-600">
            <span class="font-medium text-black dark:text-white">{{ log.user }}</span>
            <span>{{ log.created_at }}</span>
          </div>
          <div class="mt-1">{{ log.description }}</div>

          <pre v-if="log.properties && Object.keys(log.properties).length" class="text-xs mt-2 bg-gray-100 dark:bg-gray-800 p-2 rounded">
{{ JSON.stringify(log.properties, null, 2) }}
          </pre>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
