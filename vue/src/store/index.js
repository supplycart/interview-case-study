import {createStore} from 'vuex';
import axiosClient from '../axios';

const store = createStore({
    state: {
        user:{
            data:{},
            token: sessionStorage.getItem('TOKEN'),
        },
        products:{
            loading:false,
            links:[],
            data:[],
        }
    },
    getters: {},
    actions: {
        register({commit}, user){
            return axiosClient.post('/register',user)
                .then(({data}) => {
                    commit('setUser', data.user);
                    commit('setToken', data.token);
                    return data;
                })
        },
        login({commit}, user){
            return axiosClient.post('/login',user)
                .then(({data}) => {
                    commit('setUser', data.user);
                    commit('setToken', data.token);
                    return data;
                })
        },
        getUser({commit}) {
            return axiosClient.get('/user')
                .then(res => {
                    console.log(res);
                    commit('setUser', res.data)
                })
        },
        
        logout({commit}) {
            return axiosClient.post('/logout')
                .then(response => {
                    commit('logout')
                    return response;
                })
        },
        getProducts({ commit }, {url = null} = {}) {
            // commit('setProductsLoading', true)
            url = url || "/product";
            return axiosClient.get(url)
                .then((res) => {
                    // commit('setProductsLoading', false)
                    commit("setProducts", res.data);
                    return res;
                });
        },
    },
    mutations: {

        logout: (state) => {
            state.user.token = null;
            state.user.data = {};
            sessionStorage.removeItem("TOKEN");
        },
        
        setUser: (state, userData)=>{
            state.user.data = userData.user;
        },
        setToken: (state, token) => {
            state.user.token = token;
            sessionStorage.setItem('TOKEN', token);
        },
        setProductsLoading: (state, loading) => {
            state.products.loading = loading;
        },
        setProducts: (state, products) => {
            state.products.links = products.meta.links;
            state.products.data = products.data;
        },
        setProductsLoading: (state, loading) => {
            state.products.loading = loading;
        },
    },
    modules: {},
})

export default store;