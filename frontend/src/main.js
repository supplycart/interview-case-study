import Vue from 'vue'
import App from './App.vue'
import Router from 'vue-router'

import Login from './pages/LoginPage.vue'
import Register from './pages/RegisterPage.vue'

import FormContainer from './components/FormContainer.vue'

import './css/tailwind.css'

Vue.use(Router)

Vue.component('Form', FormContainer);

const router = new Router({
  routes: [
    { path: '/', component: Login, meta: { title: 'Login' }  },
    { path: '/Register', component: Register, meta: { title: 'Register' }  }
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
