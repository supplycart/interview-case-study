router.addRoutes([
    {
        path: '/login',
        name: 'login',
        component: require('./views/Login.vue')
    },
    // {
    //     path: '/register',
    //     name: 'register',
    //     component: require('./views/Register.vue')
    // },
    {
        path: '/products',
        name: 'products',
        component: require('./views/ProductList.vue')
    },
    {
        path: '/products/:id',
        name: 'productDetails',
        component: require('./views/ProductDetails.vue')
    },
    {
        path: '/cart',
        name: 'cart',
        component: require('./views/ShoppingCart.vue')
    },
    {
        path: '/orders',
        name: 'orders',
        component: require('./views/OrderHistory.vue')
    },
    {
        path: '/', redirect: '/products'
    },
])