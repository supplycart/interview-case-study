import { createApp } from 'vue'
import { store, key } from '@/store'
import App from './App.vue'
import router from './router'
import './index.css'

createApp(App).use(store, key).use(router).mount('#app')

console.debug('mounted store', store)
