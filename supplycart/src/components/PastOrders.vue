<template>
  <div :key="pastOrder.id" v-for="pastOrder in pastOrders">
    <PastOrder :pastOrder = "pastOrder"/>
  </div>
</template>

<script>
import PastOrder from './PastOrder.vue'

export default {
    name: "PastOrders",
    props: {
        pastOrders:Array
    },
    components:{
      PastOrder
    }

}
</script>

<style>
  h3{
    color: black;
  }
</style>