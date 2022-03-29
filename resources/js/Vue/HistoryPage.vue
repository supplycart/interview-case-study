<template>
    <nav-bar/>
    <div class="flex flex-col items-center max-w-5xl mx-auto relative">
        <h1 class="text-center text-5xl font-bold my-4">My Activities</h1>
        <div class="px-8 mt-4">
            <history-item v-for="activity in activities" :history="activity" :key="activity.id"/>
        </div>
    </div>
</template>

<script>
import NavBar from "./components/NavBar";
import HistoryItem from "./components/HistoryItem";
export default {
    name: "HistoryPage",
    components: {HistoryItem, NavBar},
    data() {
        return {
            activities: []
        }
    },
    methods: {
        async getHistories() {
            await axios.get("/api/histories")
                .then(res => {
                    this.activities = res.data;
                    this.activities.sort((a, b )=> {
                        return b.id - a.id;
                    })
                })
        }
    },
    created() {
        this.getHistories();
    }
}
</script>

<style scoped>

</style>
