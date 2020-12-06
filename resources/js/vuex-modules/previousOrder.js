import productRepository from "../repositories/productRepository";
import orderRepository from "../repositories/orderRepository";

const state = () => ({
    orders: []
});

// getters
const getters = {
    orders: (state) => {
        return state.orders;
    }
};

// mutations
const mutations = {
    orders: (state, payload) => {
        state.orders = payload;
    }
};

const actions = {
    async fetchOrders(state) {
        const response = await orderRepository.all();
        state.commit('orders', response.data.data);
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
