<template>
    <a @click="handleClick"
       class="inline-flex items-center px-1 pt-1 border-indigo-400 text-sm
       font-bold cursor-pointer leading-5 text-gray-900
       focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out"
       :class="activeRoute ? 'border-b-2' : ''"
    >
        <slot/>
    </a>
</template>

<script>
export default {
    name: "NavigationLink",
    props: {
        routeName: ''
    },
    data() {
        return {
            activeRoute: false
        }
    },
    created() {
        this.checkCurrentRoute();
    },
    methods: {
        handleClick() {
            this.$emit('click');
        },
        checkCurrentRoute() {
            this.activeRoute = this.$router.currentRoute.name === this.routeName
        }
    },
    watch: {
        $route() {
            this.checkCurrentRoute();
        }
    }
}
</script>

<style scoped>

</style>
