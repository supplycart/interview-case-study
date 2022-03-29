<template>
    <nav-bar/>
    <div class="flex flex-row p-4 mx-auto max-w-6xl items-start">
        <category-table :loading="loading" @filter="filtering"/>
        <spacer/>
        <product-grid :products="products" :loading="loading"/>
    </div>

    <pagination :max="meta.last_page" :per-page="meta.per_page" :total="meta.total" @change="changePage" :page="page"/>
</template>

<script>
import NavBar from "./components/NavBar";
import ProductGrid from "./components/ProductGrid";
import Pagination from "./components/Pagination";
import Spacer from "./components/Spacer";
import CategoryTable from "./components/CategoryTable";

export default {
    name: "Home",
    components: {CategoryTable, Spacer, Pagination, ProductGrid, NavBar},
    data() {
        return {
            products: [],
            meta: {},
            links: {},
            loading: false,
            filterStr: "",
            page: 1
        }
    },
    methods: {
        changePage(target) {
            this.page = target;
            this.loading = true;
            axios.get("/api/products?page=" + target + this.filterStr).then(res => {
                this.loading = false;
                window.scroll({top: 0, behavior: "smooth"})
                this.products = res.data.data;
                this.meta = res.data.meta;
                this.links = res.data.links;
            })
        },
        filtering(e) {
            this.filterStr = e;
            this.page = 1;
            this.changePage(1);
        }
    },
    created() {
        this.page = 1;
        this.changePage(1);
    }
}
</script>

<style scoped>

</style>
