<template>
    <div v-if="message" :class="alertClasses" class="p-4 mb-4 text-sm rounded-lg" role="alert">
      <span class="font-medium">{{ title }}</span> {{ message }}
      <button v-if="dismissible" @click="$emit('dismiss')" type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 p-1.5 inline-flex h-8 w-8" :class="buttonClasses" aria-label="Close">
        <span class="sr-only">Dismiss</span>
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
      </button>
    </div>
  </template>
  
  <script>
  export default {
    name: 'AlertMessage',
    props: {
      type: {
        type: String,
        default: 'info', // success, error, warning, info
      },
      message: {
        type: String,
        required: true,
      },
      title: {
        type: String,
        default: '',
      },
      dismissible: {
        type: Boolean,
        default: false,
      }
    },
    emits: ['dismiss'],
    computed: {
      alertClasses() {
        const base = 'border ';
        switch(this.type) {
          case 'success': return base + 'bg-green-100 border-green-400 text-green-700';
          case 'error': return base + 'bg-red-100 border-red-400 text-red-700';
          case 'warning': return base + 'bg-yellow-100 border-yellow-400 text-yellow-700';
          default: return base + 'bg-blue-100 border-blue-400 text-blue-700';
        }
      },
      buttonClasses() {
         switch(this.type) {
          case 'success': return 'bg-green-100 text-green-500 focus:ring-green-400 hover:bg-green-200';
          case 'error': return 'bg-red-100 text-red-500 focus:ring-red-400 hover:bg-red-200';
          case 'warning': return 'bg-yellow-100 text-yellow-500 focus:ring-yellow-400 hover:bg-yellow-200';
          default: return 'bg-blue-100 text-blue-500 focus:ring-blue-400 hover:bg-blue-200';
        }
      }
    }
  }
  </script>
  