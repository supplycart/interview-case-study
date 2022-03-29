<template>
    <div class="bg-sky-50 shadow-xl rounded px-4 py-6 min-w-[25%] relative">
        <h2 class="font-bold text-xl mb-2 min-h-2">Categories</h2>
        <div v-for="cat in cats" :key="cat.name" class="py-1">
            <input
                class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                type="checkbox" :value="cat.id" :id="cat.id" checked v-model="cat.checked">
            <label class="form-check-label inline-block text-gray-700 cursor-pointer hover:text-gray-900" :for="cat.id">
                {{cat.name}}
            </label>
        </div>
        <button class="button mt-2" @click="clicked">FILTER</button>
        <loading-overlay v-if="loading"/>
    </div>
</template>

<script>
import LoadingOverlay from "./LoadingOverlay";
export default {
    name: "CategoryTable",
    components: {LoadingOverlay},
    props: ["loading"],
    data() {
        return {
            cats: [],
        }
    },
    methods: {
        clicked() {
            let catStr = "";
            this.cats.forEach(cat => {
                if (cat.checked) {
                    catStr += "&cats[]=" + cat.id;
                }
            });
            this.$emit("filter", catStr);
        }
    },
    created() {
        axios.get("/api/cats")
            .then(res => {
                this.cats = res.data.map(cat => {
                    cat.checked = false;
                    return cat
                });
            })
    }
}
</script>

<style scoped>
.min-h-2 {
    min-height: 2rem;
}
</style>
