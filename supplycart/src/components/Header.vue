<template>
  <header>
      <!-- <div class="container">  </div> -->
      <h1>{{title}}</h1>
      <Button text = "Add to cart" color = "green"/>
  </header>

</template>

<script>
import Button from './Button.vue'

export default {
    name: 'Header',
    // props: [ 'title']
    props : {
        title : {
            type: String,
            default: "Hello World"
        }
    },
    components : {
        Button,
    }
}
</script>

<style>
/* .container{
    background: blanchedalmond;
    height: 100px;
    margin-right: 0;
    display: block;
} */
* { 
    margin: 0 !important; 
}
</style>