window.axios = require('axios');

export const routes = [
    {
        path : '/products',
        name : 'products',
        component: require ("./pages/Products").default
    },
    {
        path : '/cart',
        name : 'cart',
        component: require ("./pages/Cart").default
    },
    {
        path : '/previous-orders',
        name : 'previousOrders',
        component: require ("./pages/PreviousOrder").default
    },
];
