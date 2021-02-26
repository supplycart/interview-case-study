require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('home-body', require('./components/HomeBody.vue').default);
Vue.component('cart-body', require('./components/CartBody.vue').default);

const app = new Vue({
    el: '#app',
});
