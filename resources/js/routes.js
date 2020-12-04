window.axios = require('axios');

export const routes = [
    {
        path : '/products',
        name : 'products',
        component: require ("./pages/Products").default
    }
];
