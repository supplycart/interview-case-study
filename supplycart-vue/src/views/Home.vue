<script setup>
import { ref, computed, onMounted } from 'vue';
import { useProductsStore } from '@/stores/useProducts';
import ProductCard from '@/components/ProductCard.vue';
import Filter from '@/components/Filter.vue'; 
import Loading from '@/components/Loading.vue';
import Error from '@/components/Error.vue'

const productsStore = useProductsStore();

const selectedBrand = ref(null);  // Track selected brand
const selectedCategory = ref(null);  // Track selected category

const availableBrands = computed(() => productsStore.brands);  // Get available brands
const availableCategories = computed(() => productsStore.categories);  // Get available categories

// Fetch products on mount
onMounted(async () => {
  await productsStore.fetchProducts();
});

// Computed property to filter products based on selected filters
const filteredProducts = computed(() => {
  return productsStore.products.filter(product => {
    const brandMatches = !selectedBrand.value || product.brand_id === parseInt(selectedBrand.value);
    const categoryMatches = !selectedCategory.value || product.category === selectedCategory.value;
    return brandMatches && categoryMatches;
  });
});
</script>

<template>
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Products</h1>

    <!-- Filters -->
    <Filter
      :selectedBrand="selectedBrand"
      :selectedCategory="selectedCategory"
      :availableBrands="availableBrands"
      :availableCategories="availableCategories"
      @update:selectedBrand="selectedBrand = $event"
      @update:selectedCategory="selectedCategory = $event"
    />

    <!-- Loading state -->
    <Loading v-if="productsStore.loading" />

    <!-- Error state -->
    <Error v-if="productsStore.error" :error="productsStore.error" />

    <!-- Products grid -->
    <div v-if="!productsStore.loading && !productsStore.error" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <ProductCard
        v-for="product in filteredProducts"
        :key="product.id"
        :product="product"
      />
    </div>

    <!-- No products -->
    <div v-if="filteredProducts.length === 0 && !productsStore.loading" class="text-center text-gray-600">
      No products available.
    </div>
  </div>
</template>
