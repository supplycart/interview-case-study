import Vue from 'vue'
import App from './App.vue'
import Router from 'vue-router'
import Axios from 'axios'
import VueCookies from 'vue-cookies'
import Swal from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css';

import VueX from './js/vuex.js';

import Login from './pages/LoginPage.vue'
import Register from './pages/RegisterPage.vue'
import Home from './pages/HomePage.vue'

import FormContainer from './components/FormContainer.vue'
import Cart from './components/Cart.vue'

import './css/tailwind.css'

Vue.use(Router)
Vue.use(Swal)
Vue.use(VueCookies)

Vue.component('Form', FormContainer);
Vue.component('Cart', Cart);

const router = new Router({
  routes: [
    { path: '/', component: Login, meta: { title: 'Login' }  },
    { path: '/Register', component: Register, meta: { title: 'Register' }  },
    { path: '/Home', component: Home, meta: { title: 'Home' }  }
  ],
  mode: 'history'
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title

  VueX.state.showGradient = document.title == 'Login' || document.title == 'Register'

  next()
})

Vue.$cookies.config('1d')

const axios = Axios
axios.defaults.baseURL = 'https://api.reeqzan.com'

Vue.prototype.$axios = axios

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
  router,
  store: VueX
}).$mount('#app')
