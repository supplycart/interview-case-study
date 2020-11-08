/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//Import 
import App from './App.vue';
import VueRouter from 'vue-router'
import VueAxios from 'vue-axios';
import axios from 'axios';

//Import v-from
Vue.use(VueRouter);
Vue.use(VueAxios, axios);

//Routes
import { routes } from './routes';

//Register Routes
const router = new VueRouter({
    routes, 
    mode: 'hash',

})
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const API_URL = process.env.MIX_APP_URL +'/api/'
const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});