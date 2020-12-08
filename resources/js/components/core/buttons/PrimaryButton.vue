<template>
    <button
        @click="$emit('click')"
        :clas="className"
        :disabled="shouldDisabled"
        class="bg-primary focus:shadow-outline focus:outline-none text-white bg-green-600 hover:bg-green-500 text-sm py-3 px-4 border border-primary rounded font-bold flex items-center">
        <slot/>
    </button>

</template>

<script>
export default {
    props: {
        className: {
            type: String
        },
        shouldDisabled: {
            type: Boolean,
            default: false
        }
    },
    name: "PrimaryButton"
}
</script>

<style scoped>

</style>
