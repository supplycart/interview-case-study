import {createRouter, createWebHistory} from 'vue-router';
import store from '../store';
import Login from '../views/Login.vue';
import Register from '../views/Register.vue';
import Products from '../views/Products.vue';
import DefaultLayout from '../components/DefaultLayout.vue';
import AuthLayout from '../components/AuthLayout.vue';
import Cart from '../views/Cart.vue';
import Orders from '../views/Orders.vue';

const routes =[
    {
        path: '/',
        redirect: '/products',
        component: DefaultLayout,
        meta: {requiresAuth: true},
        children: [
            {path: '/products', name: 'Products', component: Products},
            {path: '/cart', name: 'Cart', component: Cart},
            {path: '/orders', name: 'Orders', component: Orders},
        ]
    },
    {
        path: '/auth',
        redirect: '/login',
        name: 'Auth',
        component: AuthLayout,
        meta: {isGuest: true},
        children: [
            {
                path: '/login',
                name: 'Login',
                component: Login
            },
            {
                path: '/register',
                name: 'Register',
                component: Register
            }
        ]
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.token){
        next({name: 'Login'})
    }else if (store.state.user.token && (to.meta.isGuest)){
        next({name: 'Products'})
    }else {
        next()
    }
});

export default router;