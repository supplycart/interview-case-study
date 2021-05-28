import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import firebase from 'firebase'
import './assets/tailwind.css'

const firebaseConfig = {
    apiKey: "AIzaSyBU-OF23nGVLF3_n7_mHmeWpW3DM1beQ_s",
    authDomain: "vue-auth-236ee.firebaseapp.com",
    projectId: "vue-auth-236ee",
    storageBucket: "vue-auth-236ee.appspot.com",
    messagingSenderId: "17027757299",
    appId: "1:17027757299:web:7ae5951ed61bf69975b386"
};

firebase.initializeApp(firebaseConfig)

createApp(App).use(router).mount('#app')
