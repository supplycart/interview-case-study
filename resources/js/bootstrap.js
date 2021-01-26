window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {}

