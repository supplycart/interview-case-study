import {createStore} from 'vuex';
import axiosClient from '../axios';

const store = createStore({
    state: {
        user:{
            data:{},
            token: sessionStorage.getItem('TOKEN'),

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
    },
    mutations: {
        logout: (state) => {
            state.user.token = null;
            state.user.data = {};
            sessionStorage.removeItem("TOKEN");
        },
        
        setUser: (state, userData)=>{
            state.user.token = userData.token;
            state.user.data = userData.user;
            sessionStorage.setItem('TOKEN', userData.token);
        },
        setToken: (state, token) => {
            state.user.token = token;
            sessionStorage.setItem('TOKEN', token);
        },
    },
    modules: {},
})

export default store;