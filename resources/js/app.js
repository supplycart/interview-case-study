import Vue from 'vue';
require('./bootstrap');
import App from './components/App';
window.Bus = new Vue();

Vue.config.silent = true
Vue.component('flash-message', require('./components/FlashMessage.vue').default);
const app = new Vue({
    el: '#app',
    components: {
        App,
    },
});
