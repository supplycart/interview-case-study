<template>
  <label class="inline-flex items-center mt-3"> <input
      :id="id || name"
      :name="name"
      :checked="internalValue"
      type="checkbox"
      class="form-checkbox h-5 w-5 text-indigo-600"
      @click="handleClick"
  >
    <span :for="id || name" class="ml-2 text-gray-700">
      <slot/>
    </span>
  </label>
</template>

<script>
export default {
  name: 'Checkbox',

  props: {
    id: {type: String, default: null},
    name: {type: String, default: 'checkbox'},
    value: {type: Boolean, default: false},
    checked: {type: Boolean, default: false}
  },

  data: () => ({
    internalValue: false
  }),

  watch: {
    value(val) {
      this.internalValue = val
    },

    checked(val) {
      this.internalValue = val
    },

    internalValue(val, oldVal) {
      if (val !== oldVal) {
        this.$emit('input', val)
      }
    }
  },

  created() {
    this.internalValue = this.value

    if ('checked' in this.$options.propsData) {
      this.internalValue = this.checked
    }
  },

  methods: {
    handleClick(e) {
      this.$emit('click', e)

      if (!e.isPropagationStopped) {
        this.internalValue = e.target.checked
      }
    }
  }
}
</script>
