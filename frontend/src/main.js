import Vue from 'vue'
import App from './App.vue'
import Router from 'vue-router'
import Axios from 'axios'
import VueCookies from 'vue-cookies'
import Swal from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css';

import VueX from './js/vuex.js';
import Activity from './js/activity.js'

import Login from './pages/LoginPage.vue'
import Register from './pages/RegisterPage.vue'
import Home from './pages/HomePage.vue'
import Verify from './pages/VerifyPage.vue'
import History from './pages/Home/HistoryPage.vue'
import ActivityPage from './pages/Home/ActivityPage.vue'
import Product from './pages/Home/ProductPage.vue'

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
    { path: '/Verify/:id', component: Verify, meta: { title: 'Verify' }  },
    { path: '/Home', component: Home, meta: { title: 'Home' },
      children: [
        { path: '/', component: Product, meta: { title: 'Product' } },
        { path: 'History', component: History, meta: { title: 'History' } },
        { path: 'Activity', component: ActivityPage, meta: { title: 'Activity' } }
      ]
    }
  ],
  mode: 'history'
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title

  VueX.state.showGradient = document.title == 'Login' || document.title == 'Register'
  VueX.state.historyText = 'Order History'  
  VueX.state.activityText = 'My Activity'
  
  if (document.title == 'History') {
    VueX.state.historyText = 'Products'
  } else if (document.title == 'Activity') {
    VueX.state.activityText = 'Products'
  }

  next()
})

Vue.$cookies.config('1d')

const axios = Axios
// axios.defaults.baseURL = 'https://api.reeqzan.com' // Using live DB
axios.defaults.baseURL = 'https://localhost:5001' // Using local DB

Vue.prototype.$axios = axios
Vue.prototype.$activity = Activity

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
  router,
  store: VueX
}).$mount('#app')
