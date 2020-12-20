<template>
<button :type="nativeType" :disabled="loading" :class="{
    [`bg-${color}-500 hover:bg-${color}-700` ]: true,
    'btn-lg': large,
    'btn-loading': loading
  }" class=" w-full p-4 text-sm text-white uppercase font-bold tracking-wider"
  >
    <slot />
  </button>
</template>

<script>
export default {
  name: 'VButton',
  props: {
    color: {
      type: String,
      default: 'indigo'
    },
    nativeType: {
      type: String,
      default: 'submit'
    },
    loading: {
      type: Boolean,
      default: false
    },
    large: {
      type: Boolean,
      default: false
    }
  }
}
</script>
