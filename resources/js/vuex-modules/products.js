import productRepository from "../repositories/productRepository";

const state = () => ({
    products: [],
    search : "",
    searchedQuery : ""
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
};

const actions = {
    async products(state, payload) {
        const response = await productRepository.all(state.state.search);
        state.commit('products', response.data.data);
        history.pushState(
            {},
            "",
            "?q=" + state.state.search
        );
        state.commit('searchedQuery', state.state.search);
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
