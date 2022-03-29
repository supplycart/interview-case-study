<template>
    <div class="grid grid-cols-5 my-2 py-2 hover:bg-sky-100 px-2 gap-4">
        <div class="col-span-2 text-2xl font-bold flex items-center">
            {{ getType() }}
        </div>
        <div class="col-span-2 flex items-center">
            {{ getDateTime() }}
        </div>
        <div class="text-center">
            <router-link :to="`/order/${history.related_id}`" v-if="history.type == 4">
                <link-icon class="h-5 w-5 inline-block mr-2 hover:text-blue-600 text-blue-400" />
            </router-link>
            <div v-if="history.type == 3">
                <div class="text-md text-gray-500 mb-2">{{history.product.name}}</div>
                <img :src="history.product.picture" :alt="history.product.name" class="history-img"/>
            </div>
        </div>
    </div>
</template>

<script>
import {LinkIcon} from "@heroicons/vue/solid";
export default {
    name: "HistoryItem",
    components: {LinkIcon},
    props: ['history'],
    methods: {
        getType() {
            switch (this.history.type) {
                case 0:
                    return "Register";
                case 1:
                    return "Login";
                case 2:
                    return "Logout";
                case 3:
                    return "Add to Cart";
                case 4:
                    return "Placed an Order";
                case 7:
                    return "Applied for Membership"
            }
        },
        getDateTime() {
            let date = new Date(Date.parse(this.history.created_at));
            return `${date.getDate()} / ${date.getMonth()} / ${date.getFullYear()} | ${date.getHours()}:${String(date.getMinutes()).padStart(2, '0')}`;
        }
    }
}
</script>

<style scoped>
.history-img {
    width: 100%;
    aspect-ratio: 1;
    object-fit: cover;
    object-position: center;
}
</style>
