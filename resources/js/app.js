require('./bootstrap');

import { createApp } from 'vue';
import LoginPage from './components/LoginPage.vue';
import HomePage from './components/HomePage.vue';

let app = createApp({
    components: {
        LoginPage,
        HomePage
    }
});

app.config.globalProperties.PROJECT_PATH = "/";

app.mount('#app');