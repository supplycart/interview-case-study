import productRepository from "../repositories/productRepository";
import brandRepository from "../repositories/brandRepository";
import categoyRepository from "../repositories/categoyRepository";

const state = () => ({
    products: [],
    search: "",
    searchedQuery: "",
    categories: [],
    brands: [],
    category: '',
    brand: ''
});

// getters
const getters = {
    products: (state) => {
        return state.products;
    },
    search: (state) => {
        return state.search;
    },
    searchedQuery: (state) => {
        return state.searchedQuery;
    },
    brands: (state) => {
        return state.brands;
    },
    categories: (state) => {
        return state.categories;
    },
    brand: (state) => {
        return state.brand;
    },
    category: (state) => {
        return state.category;
    },
};

// mutations
const mutations = {
    products: (state, payload) => {
        state.products = payload;
    },
    search: (state, payload) => {
        state.search = payload;
    },
    searchedQuery: (state, payload) => {
        state.searchedQuery = payload;
    },
    brands: (state, payload) => {
        state.brands = payload;
    },
    categories: (state, payload) => {
        state.categories = payload;
    },
    brand: (state, payload) => {
        state.brand = payload;
    },
    category: (state, payload) => {
        state.category = payload;
    },
};

const actions = {
    async products(state, payload) {
        const url = `q=${state.state.search}&category=${state.state.category}&brand=${state.state.brand}`;
        console.log({url});
        const response = await productRepository.all(url);
        state.commit('products', response.data.data);
        history.pushState(
            {},
            "",
            "?" + url
        );
        state.commit('searchedQuery', state.state.search);
    },
    async categories(state) {
        const response = await categoyRepository.all();
        state.commit('categories', response.data);
    },
    async brands(state) {
        const response = await brandRepository.all();
        state.commit('brands', response.data);
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
