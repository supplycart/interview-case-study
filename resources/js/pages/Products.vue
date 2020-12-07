<template>

    <main class="my-8">
        <div class="container mx-auto px-6">
            <h3 class="text-gray-700 text-2xl font-medium">{{ searchedQuery }}</h3>
            <div class="flex">
                <div class="flex-1">
                    <label for="brands">Brands</label>
                    <select v-model="brand"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="brands" name="brands">
                        <option v-for="brand in brands" :key="brand.id" :value="brand.name">{{ brand.name }}</option>
                    </select>
                </div>

                <div class="flex-1 ml-2">
                    <label for="categories">Categories</label>
                    <select
                        v-model="category"
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="categories" name="categories">
                        <option v-for="category in categories" :key="category.id" :value="category.name">
                            {{ category.name }}
                        </option>
                    </select>
                </div>

            </div>
            <span class="mt-3 text-sm text-gray-500">{{ products.length }} Products</span>
            <div v-if="products.length"
                 class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                <Product v-for="product in products" :product="product" :key="product.id"/>
            </div>
        </div>
    </main>
</template>

<script>
import Product from "../components/products/Product";
import {mapGetters} from "vuex";
import Title from "../components/core/Title";
import categoyRepository from "../repositories/categoyRepository";
import brandRepository from "../repositories/brandRepository";
import PrimarySelect from "../components/core/PrimarySelect";

export default {
    name: "Products",
    components: {PrimarySelect, Title, Product},
    computed: {
        ...mapGetters(
            'products', [
                'products', 'searchedQuery'
            ]
        ),
        ...mapGetters('user', [
            'user'
        ]),
        ...mapGetters('products', [
            'categories', 'brands'
        ]),
        category: {
            get() {
                return this.$store.getters['products/category']
            },
            set(val) {
                return this.$store.commit('products/category', val);
            }
        },
        brand: {
            get() {
                return this.$store.getters['products/brand'];
            },
            set(val) {
                return this.$store.commit('products/brand', val);
            }
        }
    },
    created() {
        this.fetchProducts();
        this.$store.dispatch('products/categories');
        this.$store.dispatch('products/brands');
    },
    methods: {
        fetchProducts() {
            const route = this.$router.currentRoute.query;
            if (route.q !== undefined && route.q !== '')
                this.$store.commit('products/search', route.q);
            if (route.brand !== undefined && route.brand !== '')
                this.$store.commit('products/brand', route.brand);
            if (route.category !== undefined && route.category !== '')
                this.$store.commit('products/category', route.category);
            this.$store.dispatch('products/products');
        }
    },
}
</script>

<style scoped>

</style>
