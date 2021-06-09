import { createApp } from 'vue'
import { store, key } from '@/store'
import axios from 'axios'
import App from './App.vue'
import router from './router'
import './index.css'

axios.defaults.headers.common.Accept = 'application/json'

createApp(App).use(store, key).use(router).mount('#app')

console.debug('mounted store', store)
