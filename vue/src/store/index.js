import {createStore} from 'vuex';
import axiosClient from '../axios';
const store = createStore({
    state: {
        user:{
            data:{},
            token: sessionStorage.getItem('TOKEN'),
        },
        products:{
            links:[],
            data:[],
        },
        orders:{
            data:[],
        },
        cartItems:{
            data:[],
            totalCart:'',
        },
        notification: {
            show: false,
            type: 'success',
            message: ''
        },

    },
    getters: {
        calcSum(state){
            let total = 0;
            state.cartItems.data.forEach((item, i) => {
                 total += item.product_price * item.quantity;
            });
            state.cartItems.totalCart= total;
            return total;
        }    
    },
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
                    console.log(res);
                    // commit('setProductsLoading', false)
                    commit("setProducts", res.data);
                    return res;
                });
        },
        getCartItems ({ commit }) {
            return axiosClient.get('/cart').then((res) => {
                console.log(res);
                commit("setCarts", res.data);
                return res;
            });

        },
        addCartItem ({ commit, dispatch }, cartItems) {
            axiosClient.post(`/cart/add/${cartItems.id}`,cartItems)
                .then((res) => {
                    console.log(res)
                    return res;
                })
                .catch(error => {
                    console.log(error)
            });
        },
        saveOrder({commit, dispatch}, orders) {
            axiosClient.post('/orders', orders)
            .then((res) => {
                commit('setOrders', res.data)
                console.log(res);
                return res;
            });
        },
        removeCartItem ({ commit }, cartItems) {
            axiosClient.post(`/cart/remove/${cartItems.product_id}`, cartItems).then((res) => {
                console.log(res)
                location.reload()
                return res;
            });
        },
        getOrders ({ commit }) {
            return axiosClient.get('/orders').then((res) => {
                console.log(res);
                commit("setOrders", res.data);
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
        setOrders: (state, orders) => {
            state.orders.data = orders.data;
        },
        setProductsLoading: (state, loading) => {
            state.products.loading = loading;
        },
        setCarts: (state, cartItems) => {
            state.cartItems.data = cartItems.data;
        },
        notify: (state, {message, type}) => {
            state.notification.show = true;
            state.notification.type = type;
            state.notification.message = message;
            setTimeout(() => {
              state.notification.show = false;
            }, 3000)
        },

    },
    modules: {},
})

export default store;