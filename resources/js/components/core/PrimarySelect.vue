<template>
    <select
        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        @change="$emit('update:modelValue', $event.target.value)"
        :id="id" :name="id">
        <slot/>
    </select>
</template>

<script>
export default {
    props: {
        id: {
            type: String
        }
    },
    name: "PrimarySelect"
}
</script>

<style scoped>

</style>
