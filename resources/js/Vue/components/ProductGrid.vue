<template>
    <div class="grid grid-cols-3 justify-items-stretch max-w-3xl gap-2 relative min-h-screen">
        <product v-for="product in products" :product="product" @selected="selectProduct(product)" :key="product.id"/>
        <loading-overlay v-if="loading"/>
    </div>
    <product-dialog :is-open="isOpen" :product="selectedProduct" @close="isOpen = false"/>
</template>

<script>
import Product from "./Product";
import ProductDialog from "./ProductDialog";
import LoadingOverlay from "./LoadingOverlay";
export default {
    name: "ProductGrid",
    components: {LoadingOverlay, ProductDialog, Product},
    props: ["products", "loading"],
    data() {
        return {
            selectedProduct: null,
            isOpen: false
        }
    },
    methods: {
        selectProduct(product) {
            this.selectedProduct = product;
            this.isOpen = true;
        }
    }
}
</script>

<style scoped>

</style>
