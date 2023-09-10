<template>
    <div>
      <input v-model="number" type="number" min="1" class="w-[48px] text-[13px] py-1 px-2 rounded-sm border-gray-300 focus:ring-0 focus:border-gray-300"/>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        number: 0, // Initial value
      };
    },
   
  };
  </script>
  