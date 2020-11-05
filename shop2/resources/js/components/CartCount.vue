<template>
    <button class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">
        Cart
        <span class="text-red-800 font-bold">
            {{ cartcount }}
        </span>
    </button>
</template>
<script>
export default {
    props:['cartcount'],

    data(){
        return{
            
        }
    },

    mounted(){
        console.log('Component mounted.')
    }
}
</script>