//define a routes
function page(path) {
    return () => import(/* webpackChunkName: '' */ `./pages/${path}`).then(m => m.default || m)
}


export default  [
    {path: '/', name: 'welcome', component: page('Home.vue')},
    {path: '/login', name: 'login', component: page('auth/Login.vue')},
    {path: '/register', name: 'register', component: page('auth/Register.vue')},
    {path: '/products', name: 'products', component: page('Product.vue')},
]
