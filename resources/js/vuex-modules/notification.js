import productRepository from "../repositories/productRepository";

const state = () => ({
    notification: {
        message : ''
    }
});

// getters
const getters = {
    notification: (state) => {
        return state.notification;
    },
};

// mutations
const mutations = {
    notification: (state, payload) => {
        state.notification = payload;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    mutations
};
