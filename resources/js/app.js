import Vue from 'vue';
import VueRouter from 'vue-router'
import Meta from 'vue-meta'
import router from './router'

Vue.use(VueRouter)
Vue.use(Meta)

import App from './components/App'
import './components'
import store from './store'
import routes from './routes'

try {
    window._ = require('lodash');

    window.axios = require('axios');
    window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    window.$ = window.jQuery = require('jquery');
} catch (e) {
}


// const router = new VueRouter({
//     mode: 'history',
//     routes: routes,
// })

// Vue.use(Vuex)

const app = new Vue({
    el: '#app',
    // components: {App},
    router,
    store,
    ...App

});