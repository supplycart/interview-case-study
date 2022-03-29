import App from "./Vue/App";
import { createApp } from 'vue'
import router from "./router";

require('./bootstrap');

const app = createApp(App).use(router);
app.mount('#app')
