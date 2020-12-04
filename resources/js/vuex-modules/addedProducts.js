import productRepository from "../repositories/productRepository";
import addedProductRepository from "../repositories/addedProductRepository";

const state = () => ({
    addedProducts: []
});

// getters
const getters = {
    addedProducts: (state) => {
        return state.addedProducts;
    }
};

// mutations
const mutations = {
    addedProducts: (state, payload) => {
        state.addedProducts = payload;
    }
};

const actions = {
    async fetchAddedProducts() {
        const response = await addedProductRepository.all();
        state.state.commit('addedProducts', response.data);
    },
    async addProduct(state, payload) {
        const response = await addedProductRepository.store(payload);
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
