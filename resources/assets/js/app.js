import './bootstrap';
import "tailwindcss/tailwind.css"

require('./components.js')

import 'es6-promise/auto'
import store from './store'

/**
* Vue Router
*/
import router from './router.js'
window.router = router

const app = new Vue({
    el: '#app',
    router,
    store
});

require('./routes.js')