import productRepository from "../repositories/productRepository";

const state = () => ({
    products: [],
    search : ""
});

// getters
const getters = {
    products: (state) => {
        return state.products;
    },
    search: (state) => {
        return state.search;
    },
};

// mutations
const mutations = {
    products: (state, payload) => {
        state.products = payload;
    },
    search: (state, payload) => {
        state.search = payload;
    }
};

const actions = {
    async products(state, payload) {
        const response = await productRepository.all(state.state.search);
        state.commit('products', response.data.data);
        console.log({response});
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
