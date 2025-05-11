<template>
    <div>
      <label v-if="label" :for="id" class="block text-sm font-medium text-gray-700 mb-1">{{ label }}</label>
      <input
        :id="id"
        :type="type"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :placeholder="placeholder"
        :disabled="disabled"
        :required="required"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
        :class="{ 'border-red-500 focus:ring-red-500 focus:border-red-500': error }"
      />
      <p v-if="error" class="mt-1 text-xs text-red-600">{{ error }}</p>
    </div>
  </template>
  
  <script>
  export default {
    name: 'AppInput',
    props: {
      id: { type: String, required: true },
      modelValue: { type: [String, Number], default: '' },
      label: { type: String, default: '' },
      type: { type: String, default: 'text' },
      placeholder: { type: String, default: '' },
      disabled: { type: Boolean, default: false },
      required: { type: Boolean, default: false },
      error: { type: String, default: '' }
    },
    emits: ['update:modelValue']
  };
  </script>
  