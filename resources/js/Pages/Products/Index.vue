<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-flex">
                Shop
            </h2>
            <div class="relative inline-flex ml-6">
                <select
                    class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none"
                    v-model="productCategory"
                    @change="onChangeProductCategory"
                >
                    <option :value="0">Choose a category</option>
                    <option
                        v-for="category in categories"
                        :category="category"
                        :key="category.id"
                        :value="category.id"
                    >
                        {{ category.name }}
                    </option>
                </select>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 relative">
                        <div v-if="isOverlay" class="absolute w-full h-full block top-0 left-0 bg-white opacity-75 z-50">
                        </div>
                        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                            <ProductGridItem
                                v-for="product in products"
                                :key="product.id"
                                :product="product"
                                @addToCart="addItemToCart"
                            >
                            </ProductGridItem>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
import BreezeDropdown from '@/Components/Dropdown'
import BreezeDropdownLink from '@/Components/DropdownLink'
import ProductGridItem from '@/Components/Products/GridItem'

export default {
    components: {
        ProductGridItem,
        BreezeAuthenticatedLayout,
        BreezeDropdownLink,
    },
    data() {
        return {
            isOverlay: false,
            categories: [],
            productCategory: 0,
            products: [],
        };
    },
    created() {
        this.getCategories();
        this.getProducts();
    },
    methods: {
        onChangeProductCategory() {
            if (this.productCategory !== 0) {
                this.isOverlay = true;
                this.getProducts(this.productCategory);
            }
        },
        async getCategories() {
            axios.get(route('api.category.list'))
                .then(response => {
                    this.categories = response.data;
                });
        },
        async getProducts(catId) {
            axios.get(route('api.product.list', {
                catId,
            }))
                .then(response => {
                    setTimeout(() => {
                        this.isOverlay = false;
                        this.products = response.data;
                    }, 500);
                });
        },
        async addItemToCart(productId) {
            this.isOverlay = true;

            await axios.post(route('api.cart.update'), {
                product_id: productId,
            })
                .then(response => {
                    setTimeout(() => {
                        this.isOverlay = false;
                    }, 500);
                });
        },
    },
}
</script>
