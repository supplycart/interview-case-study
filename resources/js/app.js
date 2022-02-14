require('./bootstrap');
require('alpinejs');

import { createApp, h } from "vue";
import Alpine from 'alpinejs';
import Home from './components/Home.vue';
import Product from './components/Product.vue';
import Cart from './components/Cart.vue';
import Order from './components/Order.vue';
import Trail from './components/Trail.vue';

window.Alpine = Alpine;

const app = createApp({
    components: {
        Home,
        Product,
        Cart,
        Order,
        Trail
    }
});

app.mount("#app");
Alpine.start();