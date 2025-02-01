<script setup>
const props = defineProps({
  modelValue: {
    type: Number,
    default: 1,
  },
});

const emit = defineEmits(['update:modelValue']);

const decrease = () => {
  if (props.modelValue > 1) {
    emit('update:modelValue', props.modelValue - 1);
  }
};
const increase = () => {
  emit('update:modelValue', props.modelValue + 1);
};
</script>

<template>
  <div class="flex items-center space-x-2">
    <button
      @click="decrease"
      class="px-2 py-1 bg-gray-300 rounded hover:bg-gray-400"
    >
      −
    </button>
    <span class="font-bold">{{ modelValue }}</span>
    <button
      @click="increase"
      class="px-2 py-1 bg-gray-300 rounded hover:bg-gray-400"
    >
      +
    </button>
  </div>
</template>
