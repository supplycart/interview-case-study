import { createApp } from 'vue';
import { createPinia } from 'pinia';
import router from './router';

// Bonus: For notifications (like vue-toastification)
import Toast, { POSITION } from "vue-toastification";
import "vue-toastification/dist/index.css";
import App from './App.vue';

import '@/style.css'


// Optional: To fetch CSRF token on app start for Sanctum SPA
// import { fetchCsrfToken } from './services/api';
// fetchCsrfToken(); // Call it once on app load

const app = createApp(App);

app.use(createPinia());
app.use(router);
app.use(Toast, {
    position: POSITION.TOP_RIGHT,
    timeout: 3000,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideProgressBar: true,
    closeButton: "button",
    icon: true,
    rtl: false
});

// Attempt to initialize auth state when app loads (e.g., if token exists in localStorage)
// Needs to be done after Pinia is initialized
// const authStore = useAuthStore(); // Don't call useAuthStore here directly (outside setup/component)
// Instead, call it in App.vue's created/mounted or router.beforeEach

router.isReady().then(() => {
    app.mount('#app');
});
