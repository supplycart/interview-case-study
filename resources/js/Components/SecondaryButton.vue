<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        :type="type"
        class=" border-[1px] 
                w-full
                bg-white border-[#80041c] 
                p-1 
                text-[18px] 
                font-roboto 
                text-[#80041c] 
                hover:bg-[#80041c] 
                hover:text-white 
                hover:underline 
                hover:font-bold 
                cursor-pointer"
    >
        <slot />
    </button>
</template>
