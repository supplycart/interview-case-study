<template>
  <div class="bg-white rounded shadow">
    <div v-if="title" class="border-b py-8 font-bold text-black text-center text-xl tracking-widest uppercase">
      {{ title }}
    </div>

    <div class="bg-grey-lightest px-10 py-10">
      <slot/>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Card',
  props: {
    title: {type: String, default: null}
  }
}
</script>
