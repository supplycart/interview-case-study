<template>
  <div class="main-layout">
    <navbar/>
    <div class="container mx-auto p-8">
      <child/>
    </div>

  </div>
</template>

<script>
import Navbar from './Navbar'

export default {
  name: 'MainLayout',

  components: {
    Navbar
  }
}
</script>
