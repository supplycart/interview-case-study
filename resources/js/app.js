import axios from 'axios'
import VueAxios from 'vue-axios'
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.use(VueAxios, axios)
Vue.use(VueToast);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const header = new Vue({
  el: '#header',
  data: {
    mobileMenuOpen: false
  },
  methods: {

  },
});

const app = new Vue({
  el: '#app',
  data: {
    message: '',
    notifications: []
  },
  methods: {
    addToCart : function(id) {
      var url = "/shop/add/" + id;
      this.$http.post(
        url, 
        {  }
      ).then(data => {
        console.log(data);
        let instance = Vue.$toast.open('Added to Cart!');
      });
    }
  },
});