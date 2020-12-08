import axios from 'axios';
import productRepository from "../repositories/productRepository";

const state = () => ({
    user: {
        name: '',
        verified: false
    }
});

// getters
const getters = {
    user: (state) => {
        return state.user;
    },
};

// mutations
const mutations = {
    user: (state, payload) => {
        state.user = payload;
    }
};

const actions = {
    async fetchUser(state, payload) {
        const response = await axios.get('api/user');
        let user = response.data;
        user.verified = response.data.email_verified_at !== null;
        state.commit('user', user);
    }
}

export default {
    namespaced: true,
    state,
    actions,
    getters,
    mutations
};
