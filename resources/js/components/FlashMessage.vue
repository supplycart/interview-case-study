<template>
  <div class="fixed top-0 right-0 m-6">
    <Transition name="slide-fade">
      <div
          v-if="message"
          :class="{
          'bg-red-200 text-red-900': type === 'error',
          'bg-green-200 text-green-900': type === 'success'
        }"
          class="rounded-lg shadow-md p-6 pr-10"
          style="min-width: 240px"
      >
        <button class="opacity-75 cursor-pointer absolute top-0 right-0 py-2 px-3 hover:opacity-100" @click="message=null">
          ×
        </button>
        <div class="flex items-center">
          {{ message }}
        </div>
      </div>
    </Transition>
  </div>
</template>

<script>
export default {
  name: 'FlashMessage',
  props: {
    id: {type: String, default: null},
    name: {type: String, default: 'checkbox'},
    value: {type: Boolean, default: false},
    type: {type: String, default: 'success'},
    message: {type: String, default: 'sucess'}
  },

  data() {
    return {};
  },
};
</script>