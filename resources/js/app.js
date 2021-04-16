require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

// Sweetalert2
import VueSweetalert2 from 'vue-sweetalert2';
const sweetalert_settings = {
    buttonsStyling: false,
    customClass: {
        confirmButton: 'py-4 px-8 sm:rounded-lg shadow-sm text-indigo-400 border border-indigo-400 hover:bg-indigo-400 hover:text-white',
        cancelButton: 'py-4 px-8 sm:rounded-lg shadow-sm text-gray-300 border border-gray-300 text-white hover:bg-grey-300 hover:text-white',
    }
};

// MomentJS
import moment from 'moment';

const el = document.getElementById('app');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({
        methods: {
            route,
            moment: moment,
        }
    })
    .use(InertiaPlugin)
    .use(VueSweetalert2, sweetalert_settings)
    .mount(el);

InertiaProgress.init({ color: '#4B5563' });
