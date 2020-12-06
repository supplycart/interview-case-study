<template>
</template>

<script>
export default {
    name: "ToastNotification",

    computed: {
        notification() {
            return this.$store.getters['notification/notification']
        }
    },
    watch: {
        notification() {
            this.$toast.success(
                this.notification.message == "" ?
                    'Product added to cart' : this.notification.message, {position: 'top'});
        }
    }
}
</script>

<style scoped>

</style>
