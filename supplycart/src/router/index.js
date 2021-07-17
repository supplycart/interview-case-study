import {createRouter, createWebHistory} from 'vue-router'

import SignUp from '../components/SignUp.vue'
import SignIn from '../components/SignIn.vue'

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

    }
]

const router = createRouter(
    {
        history: createWebHistory(process.env.BASE_URL),
        routes,

    }
)

export default router
