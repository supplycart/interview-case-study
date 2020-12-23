router.addRoutes([
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
        path: '/', redirect: '/product'
    },
])