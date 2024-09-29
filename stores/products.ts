import { defineStore } from "pinia";
import { ref } from "vue";
import {
    Product
} from '../resources/js/types';

export const useProductStore = defineStore('product', () => {
    const products = ref([]);
    function putAllProducts(products: Product[]) {
        products = products;
    }
  
    return { products, putAllProducts };
  })