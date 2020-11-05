/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Form from './Form';


window.Form = Form;

window.bus = new Vue();


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
Vue.component('create-product', require('./components/CreateProductComponent.vue').default);
Vue.component('show-product', require('./components/ShowProductComponent.vue').default);
Vue.component('cart-info', require('./components/CartInfoComponent.vue').default);
Vue.component('cart-count', require('./components/CartCount.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    data:{
        cart: [],
        total: '',
    },

    created(){
        this.getCart();

        bus.$on('product-added', (name,price) => {
            console.log(name,price);
            this.addToCart(name,price);
        });

        bus.$on('remove-product',(product)=>{
            this.removeFromCart(product);
        });


    },

    computed: {
        cartTotal(){
            let total = 0;
            this.cart.forEach(function(product){
                total += parseFloat(product.price);
            });
            return total;
        },
    },

    methods:{
        getCart () {
            this.cart = [];
        },

        addToCart(name,price){
            // const matchingProductIndex = this.cart.findIndex((item) => {
            //     return item.id === product.id;
            // });

            // if (matchingProductIndex > -1) {
            //     this.cart[matchingProductIndex].qty++;
            // } else {
            //     product.qty = 1;
            //     this.cart.push(product);

            // }

            // localStorage.setItem('cart', JSON.stringify(this.cart));
            this.cart.push({
                "name" : name,
                "price" : price,
            });
            //alert('added')
            localStorage.setItem('cart', JSON.stringify(this.cart));
        },
        removeFromCart(product){
            // const matchingProductIndex = this.cart.findIndex((item) => {
            //     return item.id == product.id;
            // });

            // if (this.cart[matchingProductIndex].qty <= 1) {
            //     this.cart.splice(matchingProductIndex, 1);
            // } else {
            //     this.cart[matchingProductIndex].qty--;
            // }
            this.cart.splice({
                "name" : name,
                "price" : price,
            });
            alert('removed')

            localStorage.setItem('cart', JSON.stringify(this.cart));
        },
    }
});
