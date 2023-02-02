<template>
    <PageComponent title="Products">
        <div v-if="products.loading" class="flex justify-center">Loading...</div>
        <div v-else-if="products.data.length">
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 md:grid-cols-3">
                <ProductCard
                v-for="(product, ind) in products.data"
                :key="product.id"
                :product="product"
                />
            </div>
            <div class="flex justify-center mt-5">
                <nav
                class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
                aria-label="Pagination"
                >
                <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                <a
                    v-for="(link, i) of products.links"
                    :key="i"
                    :disabled="!link.url"
                    href="#"
                    @click="getForPage($event, link)"
                    aria-current="page"
                    class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
                    :class="[
                    link.active
                        ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                        : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                    i === 0 ? 'rounded-l-md bg-gray-100 text-gray-700' : '',
                    i === products.links.length - 1 ? 'rounded-r-md' : '',
                    ]"
                    v-html="link.label"
                ></a>
                </nav>
            </div>
        </div>
        <div v-else class="text-gray-600 text-center py-16">
            Your don't have products yet
        </div>
    </PageComponent>
</template>

<script setup>
import ProductCard from "../components/ProductCard.vue";
import {computed} from 'vue';
import store from "../store";
import PageComponent from "../components/PageComponent.vue";

const products = computed(() => store.state.products);

store.dispatch("getProducts");

function getForPage(ev, link) {
  ev.preventDefault();
  if (!link.url || link.active) {
    return;
  }
  store.dispatch("getProducts", { url: link.url });
}
</script>