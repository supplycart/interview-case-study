import Vue from 'vue';
import router from './router';
require('./bootstrap');
import App from './components/App';
import _ from 'lodash';

const app = new Vue({
    el: '#app',
    components: {
        App
    },
    router
});
