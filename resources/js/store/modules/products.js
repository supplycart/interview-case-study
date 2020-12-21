import axios from 'axios'
import * as types from "../mutation-types";
import Cookies from "js-cookie";

// state
export const state = {
    categories: null,
    brands: null
}

// getters
export const getters = {
    categories: state => state.categories,
    brands: state => state.brands,
}

// mutations
export const mutations = {
    ['SAVE_CATEGORIES'](state, {data}) {
        state.categories = data.data
    },
    ['SAVE_BRANDS'](state, {data}) {
        state.brands = data.data
    },
}


// actions
export const actions = {
    async fetchCategories({commit}) {
        try {
            // const {data} = await axios.get('/api/user', {headers: {"Authorization": `Bearer ${state.token}`}})
            const {data} = await axios.get('/api/categories')
            commit('SAVE_CATEGORIES', {data: data})
        } catch (e) {
            console.log(e)
            // commit(types.FETCH_USER_FAILURE)
        }
    },
    async fetchBrands({commit}) {
        try {
            // const {data} = await axios.get('/api/user', {headers: {"Authorization": `Bearer ${state.token}`}})
            const {data} = await axios.get('/api/brands')
            commit('SAVE_BRANDS', {data: data})
        } catch (e) {
            console.log(e)
            // commit(types.FETCH_USER_FAILURE)
        }
    }
}
