require('./bootstrap');

// require('alpinejs');
import {routes} from './routes';

import VueRouter from "vue-router";
import Vuex from 'vuex';

import Vue from 'vue/dist/vue';
import products from "./vuex-modules/products";

// window.Vue = Vue;
window.Vue = require('vue');
const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// [VueRouter, Vuex].forEach((x) => Vue.use(x));

Vue.use(VueRouter);
Vue.use(Vuex);

Vue.component('default-transition', {
    template : '\  <transition\n' +
        'enter-active-class="transition ease-out duration-100"\n' +
        'enter-class="opacity-0 scale-95 transform"\n' +
        'enter-to-class="opacity-100 scale-100 transform"\n' +
        'leave-active-class="transition ease-in duration-75"\n' +
        'leave-class="opacity-100 scale-100 transform"\n' +
        'leave-to-class="opacity-0 scale-95 transform"\n' +
        '>\
        \<slot></slot>\
        </transition>',
});

Vue.directive('click-outside', {

    bind: function (el, binding, vNode) {
        // Provided expression must evaluate to a function.
        if (typeof binding.value !== 'function') {
            const compName = vNode.context.name
            let warn = `[Vue-click-outside:] provided expression '${binding.expression}' is not a function, but has to be`
            if (compName) {
                warn += `Found in component '${compName}'`
            }

            console.warn(warn)
        }
        // Define Handler and cache it on the element
        const bubble = binding.modifiers.bubble
        const handler = (e) => {
            if (bubble || (!el.contains(e.target) && el !== e.target)) {
                binding.value(e)
            }
        }
        el.__vueClickOutside__ = handler

        // add Event Listeners
        document.addEventListener('click', handler)
    },

    unbind: function (el, binding) {
        // Remove Event Listeners
        document.removeEventListener('click', el.__vueClickOutside__)
        el.__vueClickOutside__ = null

    }

});

const router = new VueRouter({
    mode: 'history',
    routes,
    linkActiveClass: 'active', // apply active class when url matches the route
    linkExactActiveClass: 'active'
})

const store = new Vuex.Store({
    modules: {
        products
    }
});

const app = new Vue({
    el: '#app',
    store,
    router
});

