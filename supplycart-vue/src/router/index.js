import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import { useAuthStore } from '../stores/auth'
import Cart from '../views/Cart.vue'
import OrderHistory from '../views/OrderHistory.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      meta: { title: 'Home', middleware: [] }, // Allow users to browse product listing without login
      component: Home,
    },
    {
      path: '/login',
      name: 'login',
      meta: { title: 'Login', middleware: ['guest'] },
      component: () => import('../views/auth/Login.vue'),
    },
    {
      path: '/register',
      name: 'register',
      meta: { title: 'Register', middleware: ['guest'] },
      component: () => import('../views/auth/Register.vue'),
    },
    {
      path: '/forgot-password',
      name: 'forgot-password',
      meta: { title: 'Forgot Password', middleware: ['guest'] },
      component: () => import('../views/auth/ForgotPassword.vue'),
    },
    // {
    //   path: '/dashboard',
    //   name: 'dashboard',
    //   meta: { title: 'Dashboard', middleware: ['auth', 'verified'] },
    //   component: () => import('../views/Dashboard.vue'),
    // },
    {
      path: '/verify-email',
      name: 'verify-email',
      meta: { title: 'Email Verify', middleware: ['auth'] },
      component: () => import('../views/auth/VerifyEmail.vue'),
    },
    {
      path: '/password-reset/:token',
      name: 'password-reset',
      meta: { title: 'Password Reset', middleware: ['auth'] },
      component: () => import('../views/auth/PasswordReset.vue'),
    },
    {
      path: '/cart',
      name: 'cart',
      meta: { title: 'Cart', middleware: ['auth'] },  // Requires auth middleware or else will redirect to login
      component: Cart,
    },
    {
      path: '/order-history',
      name: 'orderhistory',
      meta: { title: 'Order History', middleware: ['auth'] },  // Requires auth middleware or else will redirect to login
      component: OrderHistory,
    },
  ],
})

router.beforeEach(async (to, from, next) => {
  document.title = to.meta.title + ' :: ' + import.meta.env.VITE_APP_NAME

  const auth = useAuthStore()

  // Fetch user info if not logged in yet
  if (!auth.isLoggedIn) {
    await auth.fetchUser()
  }

  // Check if route requires auth and user is not logged in
  if (to.meta.middleware.includes('auth') && !auth.isLoggedIn) {
    return next({ name: 'login' }) // Redirect to login if not authenticated
  }

  // Redirect logged-in users away from guest routes (e.g., login/register)
  if (to.meta.middleware.includes('guest') && auth.isLoggedIn) {
    return next({ name: 'home' }) // Redirect logged-in users to dashboard
  }

  next() // Proceed to the route if everything is valid
})

export default router
