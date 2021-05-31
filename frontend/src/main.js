import Vue from 'vue'
import App from './App.vue'
import Router from 'vue-router'

import Login from './pages/LoginPage.vue'

import './css/tailwind.css'

Vue.use(Router)

const router = new Router({
  routes: [
    { path: '/', component: Login, meta: { title: 'Login' }  }
  ],
  mode: 'history'
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title

  next()
})

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
  router
}).$mount('#app')
