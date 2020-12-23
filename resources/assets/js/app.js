import './bootstrap';
import "tailwindcss/tailwind.css"

require('./components.js')

/**
* Vue Router
*/
import router from './router.js'
window.router = router

const app = new Vue({
    el: '#app',
    router
});

require('./routes.js')