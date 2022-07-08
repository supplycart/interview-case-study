const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    purge: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php', './resources/js/**/*.vue'],
    darkMode: false, // or 'media' or 'class'
    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};