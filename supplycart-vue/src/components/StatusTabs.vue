<template>
    <div class="overflow-auto whitespace-nowrap mb-6 border-b">
      <button
        v-for="status in statuses"
        :key="status"
        @click="$emit('update:activeStatus', status)"
        :class="['inline-block text-gray-600 px-4 py-2', activeStatus === status ? 'font-bold border-b-2 border-black' : '']"
      >
        {{ status }}
      </button>
    </div>
</template>
  
<script setup>
  const props = defineProps({
    statuses: {
      type: Array,
      required: true
    },
    activeStatus: {
      type: String,
      required: true
    }
  });
</script>