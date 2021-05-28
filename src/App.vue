<template>
  <router-view :cartOrder="cartOrder"/>
</template>

<script>
import { onBeforeMount } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import firebase from 'firebase'

export default {
  data() {
    return {
      cartOrder: []
    }
  },
  setup() {
    const router = useRouter()
    const route = useRoute()

    onBeforeMount(() => {
      firebase.auth().onAuthStateChanged((user) => {
        if(!user) {
          router.replace('/login')
        }else if(route.path == '/login' || route.path == '/register') {
          router.replace('/')
        }
      })
    })
  }
}
</script>

<style>

</style>
