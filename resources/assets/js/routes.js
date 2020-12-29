router.addRoutes([
    {
        path: '/login',
        name: 'login',
        component: require('./views/Login.vue'),
        beforeEnter(to, from, next) {
            if (localStorage.token) {
                next('/products');
            } else {
                next();
            }
        }
    },
    {
        path: '/register',
        name: 'register',
        component: require('./views/Register.vue'),
        beforeEnter(to, from, next) {
            if (localStorage.token) {
                next('/products');
            } else {
                next();
            }
        }
    },
    {
        path: '/products',
        name: 'products',
        component: require('./views/ProductList.vue'),
        beforeEnter(to, from, next) {
            if (localStorage.token) {
                next();
            } else {
                next('/login');
            }
        }
    },
    {
        path: '/products/:id',
        name: 'productDetails',
        component: require('./views/ProductDetails.vue'),
        beforeEnter(to, from, next) {
            if (localStorage.token) {
                next();
            } else {
                next('/login');
            }
        }
    },
    {
        path: '/cart',
        name: 'cart',
        component: require('./views/ShoppingCart.vue'),
        beforeEnter(to, from, next) {
            if (localStorage.token) {
                next();
            } else {
                next('/login');
            }
        }
    },
    {
        path: '/orders',
        name: 'orders',
        component: require('./views/OrderHistory.vue'),
        beforeEnter(to, from, next) {
            if (localStorage.token) {
                next();
            } else {
                next('/login');
            }
        }
    },
    {
        path: '/', redirect: '/login'
    },
])