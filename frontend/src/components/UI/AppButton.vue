<template>
    <button
      :type="type"
      :disabled="disabled || loading"
      @click="$emit('click')"
      class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2"
      :class="[variantClass, { 'opacity-50 cursor-not-allowed': disabled || loading }, customClass]"
    >
      <LoadingSpinner v-if="loading" class="mr-2 -ml-1 h-5 w-5 text-white" />
      <slot></slot>
    </button>
  </template>
  
  <script>
  import LoadingSpinner from './LoadingSpinner.vue';
  
  export default {
    name: 'AppButton',
    components: { LoadingSpinner },
    props: {
      type: {
        type: String,
        default: 'button', // button, submit, reset
      },
      variant: {
        type: String,
        default: 'primary', // primary, secondary, danger, success, warning, info, light, dark
      },
      disabled: {
        type: Boolean,
        default: false,
      },
      loading: {
        type: Boolean,
        default: false,
      },
      customClass: {
        type: String,
        default: '',
      }
    },
    emits: ['click'],
    computed: {
      variantClass() {
        const variants = {
          primary: 'text-white bg-blue-600 hover:bg-blue-700 focus:ring-blue-500',
          secondary: 'text-blue-700 bg-blue-100 hover:bg-blue-200 focus:ring-blue-500',
          success: 'text-white bg-green-600 hover:bg-green-700 focus:ring-green-500',
          danger: 'text-white bg-red-600 hover:bg-red-700 focus:ring-red-500',
          warning: 'text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-400',
          // Add more as needed
        };
        return variants[this.variant] || variants.primary;
      }
    }
  };
  </script>
  