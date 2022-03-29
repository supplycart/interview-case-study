<template>
    <router-link :to="`/order/${order.id}`">
        <div class="grid grid-cols-6 my-2 py-2 hover:bg-sky-300 px-2">
            <div class="col-span-1 text-2xl font-bold">
                #{{order.id}}
            </div>
            <div class="flex items-center text-xl col-span-2 mx-4">
                RM {{order.payment}}
            </div>
            <div class="col-span-3 flex items-center">
                - {{getDateTime()}}
            </div>
        </div>
    </router-link>
</template>

<script>
export default {
    name: "OrderIndexItem",
    props: ["order"],
    methods: {
        getDateTime() {
            let date = new Date(Date.parse(this.order.created_at));
            return `${date.getDate()} / ${date.getMonth()} / ${date.getFullYear()} | ${date.getHours()}:${String(date.getMinutes()).padStart(2, '0')}`;
        }
    }
}
</script>

<style scoped>

</style>
