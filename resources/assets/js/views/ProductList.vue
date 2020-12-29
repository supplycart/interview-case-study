<template>
    <layout>
        <div class="flex justify-center pt-4">
            <loader v-if="loading"></loader>
            <div v-else class="w-4/5 flex">
                <div class="w-1/5 mt-2.5 pr-6">
                    <div class="divide-y divide-gray-400">
                        <div class="mb-2 text-xl font-bold">SEARCH FILTER</div>
                        <div class="my-6">
                            <div class="mt-6 mb-2 font-bold">By Category</div>
                            <div class="hover:text-blue-500 cursor-pointer" @click="resetFilter('category')">
                                All Categories ( {{ products.length }} )
                            </div>
                            <div class="hover:text-blue-500 cursor-pointer" v-for="category in filteredCategory" :key="category.id" @click="setFilter('category', category.id)">
                                {{ category.name }} ( {{ category.quantity }} )
                            </div>
                        </div>
                        <div class="my-6">
                            <div class="mt-6 mb-2 font-bold">By Brand</div>
                            <div class="hover:text-blue-500 cursor-pointer" @click="resetFilter('brand')">
                                All Brands ( {{ products.length }} )
                            </div>
                            <div class="hover:text-blue-500 cursor-pointer" v-for="brand in filteredBrands" :key="brand.id" @click="setFilter('brand', brand.id)">
                                {{ brand.name }} ( {{ brand.quantity }} )
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-4/5">
                    <div class='grid grid-cols-5 gap-5 mt-2.5'>     
                        <div class="shadow-lg border-2 border-gray-100 bg-white" v-for="product in filteredProduct" :key="product.name" @click="$router.push({ path: `/products/${product.id}` })">
                            <div class='img-thumbnail' style='height: 300px'>
                                <div class="h-3/5 overflow-hidden">
                                    <img class='img-responsive object-contain mx-auto' :src="product.image" />
                                </div>
                                <div class="text-sm overflow-hidden p-2.5 h-1/4">
                                    <strong>{{ product.name }}</strong>
                                </div>
                                <div class="row p-2" style='border-top:1px solid #d9d9d9'>
                                    <div class='flex justify-end'>
                                        <strong>RM {{ product.price }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </layout>
</template>
<script>
    import { mapActions, mapState } from 'vuex'

    export default {
        data() {
            return {
                products: [],
                filteredProduct: [],
                filter:{
                    category: 0,
                    brand: 0
                },
                brands: [],
                filteredBrands: [],
                categories: [],
                filteredCategory: [],
                loading: true
            }
        },
        async mounted() {
            await this.$store.dispatch('fetchProducts')
            this.products = this.$store.state.products
            this.filteredProduct = this.products

            await this.$store.dispatch('fetchCategories');
            this.categories = this.$store.state.categories
            this.filteredCategory = this.categories

            await this.$store.dispatch('fetchBrands');
            this.brands = this.$store.state.brands
            this.filteredBrands = this.brands

            this.loading = false
        },
        methods: {
            viewDetails(id) {
                router.push({ path: `/products/${id}` })
            },
            setFilter(type, id) {
                switch (type) {
                    case "category" : 
                        this.filter.category = id
                        break
                    case "brand" : 
                        this.filter.brand = id
                        break
                }
                
                this.updateProductList()                
            },
            resetFilter(type, id) {
                switch (type) {
                    case "category" : 
                        this.filter.category = 0
                        this.filter.brand = 0
                        break
                    case "brand" : 
                        this.filter.brand = 0
                        break
                }

                this.updateProductList()
            },
            updateProductList() {
                this.filteredProduct = this.products
                this.filteredCategory = this.categories
                this.filteredBrands = this.brands

                this.filteredProduct = this.products.filter((e) => {
                    if (this.filter.category === 0 && this.filter.brand === 0) {
                        return true
                    } else if (this.filter.category === 0 && this.filter.brand !== 0) {
                        return e.brand_id === this.filter.brand
                    } else if (this.filter.category !== 0 && this.filter.brand === 0) {
                        return e.category_id === this.filter.category
                    } else if (this.filter.category !== 0 && this.filter.brand !== 0){
                        return e.category_id === this.filter.category && e.brand_id === this.filter.brand
                    }
                })

                this.categories.forEach((e) => {
                    let index = this.filteredProduct.findIndex(el => el.category_id === e.id)
                    if (index < 0) {
                        this.filteredCategory = this.filteredCategory.filter((el) => el.id !== e.id)
                    }
                })

                this.brands.forEach((e) => {
                    let index = this.filteredProduct.findIndex(el => el.brand_id === e.id)
                    if (index < 0) {
                        this.filteredBrands = this.filteredBrands.filter((el) => el.id !== e.id)
                    }
                })
            }
        }
    }
</script>