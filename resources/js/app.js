import Vue from 'vue';
require('./bootstrap');
import App from './components/App';
import _ from 'lodash';

Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');

const app = new Vue({
    el: '#app',
    components: {
        App
    },
});
