import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'main': '#f1c232',
                'main-50': '#fff1c4',
                'main-100': '#ddc887',
                'main-200': '#d8b854',
                'main-300': '#4f91d6',
                'main-400': '#cfa62a',
                'main-500': '#e0b01b',
                'main-600': '#bf9208',
                'main-700': '#b88c05',
                'main-800': '#9c7603',
                'main-900': '#876600',
                'main-950': '#7c5e04',
            },
        },
    },

    plugins: [forms],
};
