import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import Product from '@/views/Product.vue'
import ProductPage from '@/views/ProductPage.vue'
import CheckoutPage from '@/views/CheckoutPage.vue'
import OrderListing from '@/views/OrderListing.vue'
import OrderPage from '@/views/OrderPage.vue'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: {
      guestOnly: true,
    },
  },
  {
    path: '/register',
    name: 'Register',
    component: Register,
    meta: {
      guestOnly: true,
    },
  },
  {
    path: '/products',
    name: 'Product',
    component: Product,
    meta: {
      requiresAuth: true,
    },
  },
  {
    path: '/products/:id',
    name: 'View Product',
    component: ProductPage,
    meta: {
      requiresAuth: true,
    },
  },
  {
    path: '/checkout',
    name: 'Checkout',
    component: CheckoutPage,
    meta: {
      requiresAuth: true,
    },
  },
  {
    path: '/my-orders',
    name: 'My Order',
    component: OrderListing,
    meta: {
      requiresAuth: true,
    },
  },
  {
    path: '/my-orders/:id',
    name: 'Show Order',
    component: OrderPage,
    props: true,
    meta: {
      requiresAuth: true,
    },
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
})

router.beforeEach((to, from, next) => {
  const loggedIn = localStorage.getItem('user')

  if (to.matched.some((record) => record.meta.guestOnly) && loggedIn) {
    next('/')
  }

  if (to.matched.some((record) => record.meta.requiresAuth) && !loggedIn) {
    next('/')
  }

  next()
})

export default router
