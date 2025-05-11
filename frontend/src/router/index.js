import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '@/stores/authStore';

// Views/Pages
import ProductListPage from '@/views/ProductListPage.vue';
import LoginPage from '@/views/LoginPage.vue';
import RegisterPage from '@/views/RegisterPage.vue';
import CartPage from '@/views/CartPage.vue';
import OrderHistoryPage from '@/views/OrderHistoryPage.vue';
import NotFoundPage from '@/views/NotFoundPage.vue';
import EmailVerifiedPage from '@/views/EmailVerifiedPage.vue'; // Bonus
import RegisterVerificationPage from '@/views/RegisterVerificationPage.vue'; // Bonus

const routes = [
  { path: '/', name: 'Home', component: ProductListPage },
  { path: '/products', name: 'Products', component: ProductListPage, meta: { requiresAuth: true } },
  { path: '/login', name: 'Login', component: LoginPage, meta: { guestOnly: true } },
  { path: '/register', name: 'Register', component: RegisterPage, meta: { guestOnly: true } },
  { path: '/cart', name: 'Cart', component: CartPage, meta: { requiresAuth: true } },
  { path: '/orders', name: 'OrderHistory', component: OrderHistoryPage, meta: { requiresAuth: true } },
  // Bonus: Email verification related routes
  { path: '/email-verified', name: 'EmailVerified', component: EmailVerifiedPage }, // Page shown after successful verification redirect
  { path: '/register-verification', name: 'RegisterVerificationPage', component: RegisterVerificationPage, meta: { requiresAuth: true } },

  { path: '/:pathMatch(.*)*', name: 'NotFound', component: NotFoundPage },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition;
    } else {
      return { top: 0 };
    }
  }
});

router.beforeEach((to, from, next) => {
  const authStore = useAuthStore();

  // Initialize auth store if not already (e.g. on page refresh)
  // This ensures user state is loaded when navigating directly to a protected route
  if (!authStore.user && authStore.token && !authStore.isLoading) {
    authStore.initializeAuth().then(() => {
        handleNavigation(to, from, next, authStore);
    }).catch(() => { // If init fails (e.g. token invalid)
        handleNavigation(to, from, next, authStore);
    });
  } else {
      handleNavigation(to, from, next, authStore);
  }
});

function handleNavigation(to, from, next, authStore) {
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    const guestOnly = to.matched.some(record => record.meta.guestOnly);

    if (requiresAuth && !authStore.isLoggedIn) {
        // If trying to access a protected route and not logged in, redirect to login
        next({ name: 'Login', query: { redirect: to.fullPath } });
    } else if (guestOnly && authStore.isLoggedIn) {
        // If trying to access a guest-only route (like login/register) and already logged in, redirect to home
        next({ name: 'Home' });
    } else if (requiresAuth && authStore.isLoggedIn && !authStore.user?.email_verified_at && to.name !== 'RequestVerification') {
        // Bonus: If route requires auth and email is not verified, redirect to request verification page
        // Make sure user is not null before accessing email_verified_at
        next({ name: 'RequestVerification' });
    }
     else {
        // Otherwise, allow navigation
        next();
    }
}


export default router;
