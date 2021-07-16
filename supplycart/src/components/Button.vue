<template>
  <button @click="onClick()" :style="{background: color}">{{text}}</button>
</template>

<script>
export default {
    name: 'Button',

    props: {
        text: String,
        color: String

    },

    methods: {
        onClick(){
            
        }
    }
}
</script>

<style>
    button{
        color: white;
        padding: 10px;
        border-radius: 10px;
        cursor: pointer;
    }
</style>