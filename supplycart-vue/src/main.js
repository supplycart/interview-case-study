import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faShoppingCart, faUser } from '@fortawesome/free-solid-svg-icons'
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';

// Add the icons to the library
library.add(faShoppingCart, faUser)

const app = createApp(App)

// Register FontAwesome component globally
app.component('font-awesome-icon', FontAwesomeIcon)

app.use(createPinia())
app.use(router)
app.use(Toast);

app.mount('#app')
