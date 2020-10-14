import Vue from 'vue';
require('./bootstrap');
import App from './components/App';
import _ from 'lodash';

Vue.config.silent = true

const app = new Vue({
    el: '#app',
    components: {
        App,
    },
});
