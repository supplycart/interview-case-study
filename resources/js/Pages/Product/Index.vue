<template>
    <div class="h-full rounded-lg bg-white p-3">
        <p class="text-xl font-bold mr-4 mb-3">Discover products</p>
        <!-- <hr /> -->
        <div class="flex items-center mt-3">
            <p>Filter by:</p>
            <div class="ml-3">
                <button
                    class="py-1 px-3 border-2 rounded border-slate-500 hover:bg-slate-500 hover:text-white data-active:bg-slate-600 data-active:border-slate-600 data-active:text-white"
                    :data-ui="selectedCategories.length > 0 ? 'active' : ''"
                    @click="showCategory = !showCategory"
                >
                    <span v-if="selectedCategories.length > 0">
                        {{ categoryNames }}
                    </span>
                    <span v-else>Category</span>
                </button>
                <div
                    v-if="showCategory"
                    class="border w-48 rounded mt-2 px-2 absolute bg-white shadow"
                >
                    <ul>
                        <li v-for="category in categories" class="py-1">
                            <label :for="'category_' + category.id">
                                <input
                                    :id="'category_' + category.id"
                                    type="checkbox"
                                    class="rounded"
                                    v-model="selectedCategories"
                                    :value="category.id"
                                />
                                {{ category.name }}
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="ml-3">
                <button
                    class="py-1 px-3 border-2 rounded border-slate-500 hover:bg-slate-500 hover:text-white data-active:bg-slate-600 data-active:border-slate-600 data-active:text-white"
                    :data-ui="selectedBrands.length > 0 ? 'active' : ''"
                    @click="showBrand = !showBrand"
                >
                    <span v-if="selectedBrands.length > 0">
                        {{ brandNames }}
                    </span>
                    <span v-else>Brands</span>
                </button>
                <div
                    v-if="showBrand"
                    class="border w-48 rounded mt-2 px-2 absolute bg-white shadow"
                >
                    <ul>
                        <li v-for="brand in brands" class="py-1">
                            <label :for="'brand_' + brand.id">
                                <input
                                    :id="'brand_' + brand.id"
                                    type="checkbox"
                                    class="rounded"
                                    v-model="selectedBrands"
                                    :value="brand.id"
                                />
                                {{ brand.name }}
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div
            class="grid sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mt-3"
        >
            <Card
                v-for="product in displayProducts"
                :product="product"
                :product-discount="productDiscount"
                @add-to-cart="addToCart"
            />
        </div>
    </div>
    <Toast :showToast="showToast" :toastText="toastText"></Toast>
</template>

<script>
import Card from "@/Components/product/Card.vue";
import { usePage } from "@inertiajs/vue3";
import axios from "axios";
import Toast from "@/Components/Toast.vue";

export default {
    components: {
        Card,
        Toast,
    },
    props: {
        products: Object,
        brands: Object,
        categories: Object,
    },
    data() {
        return {
            displayProducts: this.products,
            showCategory: false,
            showBrand: false,
            selectedCategories: [],
            selectedBrands: [],
            showToast: false,
            toastText: null,
            productDiscount: Number(
                usePage().props.auth.user.membership_level.discount
            ),
        };
    },
    watch: {
        showCategory(newVal, oldVal) {
            if (newVal) {
                this.showBrand = false;
            }
        },
        showBrand(newVal, oldVal) {
            if (newVal) {
                this.showCategory = false;
            }
        },
        selectedCategories(newVal, oldVal) {
            this.filterProducts();
        },
        selectedBrands(newVal, oldVal) {
            this.filterProducts();
        },
        showToast(newValue) {
            if (newValue)
                setTimeout(() => {
                    this.showToast = false;
                }, 2000);
        },
    },
    methods: {
        filterProducts() {
            let route = "/products";
            axios({
                method: "get",
                url: route,
                params: {
                    selectedCategories: this.selectedCategories,
                    selectedBrands: this.selectedBrands,
                },
            }).then((result) => {
                this.displayProducts = result.data;
                console.log(result);
            });
        },
        addToCart(product_id) {
            axios
                .post("/carts/add", {
                    product_id,
                })
                .then((response) => {
                    this.showToast = true;
                    this.toastText = response.data;
                });
        },
    },
    computed: {
        categoryNames() {
            return this.categories
                .map((category) =>
                    this.selectedCategories.includes(category.id)
                        ? category.name
                        : null
                )
                .filter((category) => category)
                .join(", ");
        },

        brandNames() {
            return this.brands
                .map((brand) =>
                    this.selectedBrands.includes(brand.id) ? brand.name : null
                )
                .filter((brand) => brand)
                .join(", ");
        },
    },
};
</script>
