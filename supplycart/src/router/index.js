import {createRouter, createWebHistory} from 'vue-router'

import SignUp from '../components/SignUp.vue'
import SignIn from '../components/SignIn.vue'
import Main from '../components/Main.vue'
import History from '../components/History.vue'

const routes = [
    {
        path:'/',
        name: 'signin',
        component: SignIn
    },
    {
        path: '/signup',
        name: 'SignUp',
        component: SignUp
    },
    {
        path: '/main',
        name: 'Main',
        component: Main
    },
    {
        path: '/history',
        name: 'History',
        component: History
    }
]

const router = createRouter(
    {
        history: createWebHistory(process.env.BASE_URL),
        routes,
    }
)

export default router
