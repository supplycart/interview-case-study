<script setup>
const props = defineProps({
  modelValue: {
    type: Number,
    default: 0,
  },
});

const emit = defineEmits([
  'update:modelValue',
  'onValueUpdate',
  'onValueEmpty',
]);

const decrease = () => {
  if (props.modelValue <= 1) {
    emit('onValueEmpty');
    return;
  }

  const newValue = props.modelValue - 1;

  emit('update:modelValue', newValue);
  emit('onValueUpdate', newValue);
};
const increase = () => {
  const newValue = props.modelValue + 1;

  emit('update:modelValue', newValue);
  emit('onValueUpdate', newValue);
};
</script>

<template>
  <div class="flex items-center space-x-2">
    <button
      @click="decrease"
      class="rounded bg-gray-300 px-2 py-1 hover:bg-gray-400"
    >
      −
    </button>
    <span class="font-bold">{{ modelValue }}</span>
    <button
      @click="increase"
      class="rounded bg-gray-300 px-2 py-1 hover:bg-gray-400"
    >
      +
    </button>
  </div>
</template>
