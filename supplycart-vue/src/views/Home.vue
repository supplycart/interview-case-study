<script setup>
import { ref, computed, onMounted } from 'vue';
import { useProductsStore } from '@/stores/useProducts';
import ProductCard from '@/components/ProductCard.vue';

const productsStore = useProductsStore();

const selectedBrand = ref(null);
const selectedCategory = ref(null);
const availableBrands = computed(() => productsStore.brands); // Use computed for available brands
const availableCategories = computed(() => productsStore.categories); // Use computed for available categories

onMounted(async () => {
  await productsStore.fetchProducts(); // Fetch products, brands, and categories data
});

// Computed property to filter products based on brand and category
const filteredProducts = computed(() => {
  return productsStore.products.filter(product => {
    const brandMatches = !selectedBrand.value || product.brand_id === selectedBrand.value;
    const categoryMatches = !selectedCategory.value || product.category === selectedCategory.value;
    return brandMatches && categoryMatches;
  });
});
</script>

<template>
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Products</h1>

    <!-- Filters for brand and category -->
    <div class="flex space-x-4 mb-4">
      <!-- Brand Filter -->
      <div>
        <label for="brand" class="block font-medium text-gray-700">Brand</label>
        <select id="brand" v-model="selectedBrand" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md">
          <option :value="null">All Brands</option>
          <option v-for="brand in availableBrands" :key="brand.id" :value="brand.id">
            {{ brand.name }}
          </option>
        </select>
      </div>

      <!-- Category Filter -->
      <div>
        <label for="category" class="block font-medium text-gray-700">Category</label>
        <select id="category" v-model="selectedCategory" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md">
          <option :value="null">All Categories</option>
          <option v-for="category in availableCategories" :key="category" :value="category">
            {{ category }}
          </option>
        </select>
      </div>
    </div>

    <!-- Loading state -->
    <div v-if="productsStore.loading" class="text-center text-gray-600">
      Loading products...
    </div>

    <!-- Error state -->
    <div v-if="productsStore.error" class="text-center text-red-600">
      {{ productsStore.error }}
    </div>

    <!-- Products grid using ProductCard component -->
    <div v-if="!productsStore.loading && !productsStore.error" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <ProductCard
        v-for="product in filteredProducts"
        :key="product.id"
        :product="product"
      />
    </div>

    <!-- If there are no products -->
    <div v-if="filteredProducts.length === 0 && !productsStore.loading" class="text-center text-gray-600">
      No products available.
    </div>
  </div>
</template>
