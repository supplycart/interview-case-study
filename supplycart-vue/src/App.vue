<script setup>
import NavBar from '@/components/NavBar.vue';

</script>

<template>
  <div>
    <NavBar />
    <Suspense>
      <RouterView />
    </Suspense>
  </div>
</template>

<style scoped></style>
